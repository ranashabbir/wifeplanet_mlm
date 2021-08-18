<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Queries\UserDataTable;
use App\Repositories\UserRepository;
use DataTables;
use Exception;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Response;

use DB;
use Auth;
use Newsletter;
use App\Models\Country;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use App\Models\Report;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @return Factory|View
     */
    public function getProfile()
    {
        return view('profile');
    }

    /**
     * Display a listing of the User.
     *
     * @param  Request  $request
     * @throws Exception
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new UserDataTable())->get($request->only(['filter_user'])))->make(true);
        }
        $roles = Role::all()->pluck('name', 'id')->toArray();

        return view('users.index')->with([
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id')->toArray();

        return view('users.create')->with(['roles' => $roles]);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  CreateUserRequest  $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $this->validateInput($request->all());

        $this->userRepository->store($input);

        return $this->sendSuccess('User saved successfully.');
    }

    /**
     * Display the specified User.
     * @param  User  $user
     *
     * @return Response
     */
    public function show(User $user)
    {
        $user->roles;
        $user = $user->apiObj();

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  User  $user
     * @return Response
     */
    public function edit(User $user)
    {
        $user->roles;
        $user = $user->apiObj();

        return $this->sendResponse(['user' => $user], 'User retrieved successfully.');
    }

    /**
     * Update the specified User in storage.
     *
     * @param  User  $user
     * @param  UpdateUserRequest  $request
     *
     * @return Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        if ($user->is_system) {
            return $this->sendError('You can not update system generated user.');
        }

        $input = $this->validateInput($request->all());
        $this->userRepository->update($input, $user->id);

        return $this->sendSuccess('User updated successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function updateLanguage(Request $request)
    {
        $language = $request->get('languageName');

        /** @var User $user */
        $user = getLoggedInUser();
        $user->update(['language' => $language]);

        return $this->sendSuccess('Language updated successfully.');
    }
        
    /**
     * Remove the specified User from storage.
     *
     * @param User $user
     * 
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function archiveUser(User $user)
    {
        if ($user->is_system) {
            return $this->sendError('You can not archive system generated user.');
        }
        $this->userRepository->delete($user->id);

        return $this->sendSuccess('User archived successfully.');
    }

    /**
     * Remove the specified User from storage.
     *
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function restoreUser(Request $request)
    {
        $id = $request->get('id');
        $this->userRepository->restore($id);

        return $this->sendSuccess('User restored successfully.');
    }

    /**
     * Remove the specified User from storage.
     *
     * @param integer $id
     * 
     * @throws Exception
     * 
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->whereId($id)->first();
        if ($user->is_system) {
            return $this->sendError('You can not delete system generated user.');
        }
        $this->userRepository->deleteUser($user->id);

        return $this->sendSuccess('User deleted successfully.');
    }

    /**
     * @param  User  $user
     *
     * @return JsonResponse
     */
    public function activeDeActiveUser(User $user)
    {
        $this->userRepository->checkUserItSelf($user->id);
        $this->userRepository->activeDeActiveUser($user->id);

        return $this->sendSuccess('User updated successfully.');
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function validateInput($input)
    {
        if (isset($input['password']) && ! empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        $input['is_active'] = (! empty($input['is_active'])) ? 1 : 0;

        return $input;
    }

    public function registeruser()
    {
        $user = Auth::user();
        $countries = Country::whereNull('deleted_at')->get();

        return view('users.register')->with(['user' => $user, 'countries' => $countries]);
    }

    public function addregisteruser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'lastname' => ['string', 'max:255'],
            'phone' => ['min:11', 'numeric'],
            'country' => ['string']
        ],
        [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be number.',
            'string' => 'The :attribute field must be string.',
            'email' => 'Please provide valid email.',
            'max' => 'The :attribute field must not be greater then :max.',
            'min' => 'The :attribute field must be greater then :min.',
        ]);

        if ($validator->fails()) {
            return redirect(route('user.registeruser'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $role = Role::where('slug', '=', 'unverified')->first();
        $country = Country::where('id', $request->input('country'))->first();
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('123456'),
            'lastname' => $request->input('lastname'),
            'phone' => $request->input('phone'),
            'country' => $country->name,
            'is_active' => 1,
            'parent_id' => Auth::user()->id
        ]);

        $profile = new Profile();
        $profile->country_id = $request->input('country');
        $user->profile()->save($profile);
        $user->attachRole($role);

        Newsletter::subscribe($request->input('email'), [
            'FNAME' => $request->input('name'),
            'LNAME' => $request->input('lastname'),
            'PHONE' => $request->input('phone')
        ]);

        return redirect(route('user.registeruser'))
        ->with('success', 'User has been registered and verification email is sent. Dummy password for user is "123456".');
    }

    public function report($user_id)
    {
        if (!$user_id) {
            return back();
        }

        $user = User::find($user_id);
        if (!$user) {
            return back();
        }
        
        $report = Report::create([
            'user_id' => $user_id,
            'reported_by' => Auth::user()->id
        ]);

        return redirect(url('/profile/'.$user_id))->with('success', 'User reported.');
    }

    public function reports()
    {
        $reports = DB::table('reports')
                        ->select(
                            'reports.*',
                            'u.name as u_fname',
                            'u.lastname as u_lname',
                            'r.name as r_fname',
                            'r.lastname as r_lname'
                        )
                        ->leftJoin('users as r', 'reports.reported_by', '=', 'r.id')
                        ->leftJoin('users as u', 'reports.user_id', '=', 'u.id')
                        ->whereNull('r.deleted_at')
                        ->get();

        return view('users.reports')->with(['reports' => $reports]);
    }

    public function blockusers($user_id)
    {
        if (!$user_id) {
            return back();
        }

        $user = User::find($user_id);
        if (!$user) {
            return back();
        }

        $user->is_active = 0;
        $user->save();

        return redirect(route('users.reports'))->with('success', 'User blocked successfully.');
    }

    public function deletereport($id)
    {
        if (!$id) {
            return back();
        }

        $report = Report::find($id);
        if (!$report) {
            return back();
        }

        $report->delete();

        return redirect(route('users.reports'))->with('success', 'Report deleted successfully.');
    }
}
