<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;

class UsersManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->hasRole('admin')) {
            return redirect()->action('UserController@index');
        }

        $pagintaionEnabled = config('usersmanagement.enablePagination');
        if ($pagintaionEnabled) {
            $users = User::with('parent')->orderBy('id', 'desc')->paginate(config('usersmanagement.paginateListSize'));
        } else {
            $users = User::with('parent')->orderBy('id', 'desc')->get();
        }
        $roles = Role::all();

        return View('usersmanagement.show-users', compact('users', 'roles', 'pagintaionEnabled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->hasRole('admin')) {
            return redirect()->action('UserController@index');
        }

        $roles = Role::all();
        $parents = User::whereNull('deleted_at')->get();

        $data = [
            'roles'     => $roles,
            'parents'   => $parents
        ];

        return view('usersmanagement.create-user')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                  => 'required|max:255|unique:users',
                'last_name'             => '',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role'                  => 'required',
                'parent_id'             => 'required',
            ],
            [
                'email.unique'        => trans('auth.userNameTaken'),
                'name.required'       => trans('auth.userNameRequired'),
                'last_name.required'  => trans('auth.lNameRequired'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'password.required'   => trans('auth.passwordRequired'),
                'password.min'        => trans('auth.PasswordMin'),
                'password.max'        => trans('auth.PasswordMax'),
                'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $profile = new Profile();

        $user = User::create([
            'name'              => $request->input('name'),
            'lastname'          => $request->input('lastname'),
            'email'             => $request->input('email'),
            'password'          => bcrypt($request->input('password')),
            'is_active'         => $request->input('is_active'),
            'parent_id'         => $request->input('parent_id'),
            'email_verified_at' => $request->input('email_verified_at') == '1' ? date("Y-m-d H:i:s", time()) : null,
        ]);

        $user->profile()->save($profile);
        $user->attachRole($request->input('role'));
        $user->save();

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin')) {
            return redirect()->action('UserController@index');
        }

        $user = User::find($id);

        return view('usersmanagement.show-user')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin')) {
            return redirect()->action('UserController@index');
        }

        $user = User::findOrFail($id);
        if (!$user) {
            return redirect()->action('UserController@index');
        }
        $roles = Role::all();
        $parents = User::whereNull('deleted_at')->get();

        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'parents'     => $parents
        ];

        return view('usersmanagement.edit-user')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentUser = Auth::user();
        $user = User::find($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);

        if ($emailCheck) {
            $validator = Validator::make($request->all(), [
                'name'     => 'required|max:255',
                'email'    => 'email|max:255|unique:users',
                'password' => 'present|confirmed|min:6',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'email'     => 'required|max:255|email|unique:users,email,'.$id,
                'password' => 'nullable|confirmed|min:6',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') != null) {
           $user->password = bcrypt($request->input('password'));
        }

        $user->is_active = $request->input('is_active');
        $user->parent_id = $request->input('parent_id');

        if($request->input('email_verified_at') == '1') {
            $user->email_verified_at = date('Y-m-d H:i:s', time());
        } else {
            $user->email_verified_at = null;
        }

        $userRole = $request->input('role');
        if ($userRole != null) {
            $user->detachAllRoles();
            $user->attachRole($userRole);
        }

        $user->save();

        return redirect('users')->with('success', trans('usersmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        if ($user->id != $currentUser->id) {
            $user->delete();

            return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('user_search_box');
        $searchRules = [
            'user_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'user_search_box.required' => 'Search term is required',
            'user_search_box.string'   => 'Search term has invalid characters',
            'user_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('id', 'like', $searchTerm.'%')
                            ->orWhere('name', 'like', $searchTerm.'%')
                            ->orWhere('email', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        foreach ($results as $result) {
            $roles = [
                'roles' => $result->roles,
            ];
            $result->push($roles);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }

    public function approve($user_id)
    {
        if (!$user_id) {
            return back()->with('error', __('User id not found.'));
        }

        $user = User::find($user_id);
        if (!$user) {
            return back()->with('error', __('User not found.'));
        }

        $user->is_active = 1;
        $user->save();
        return redirect('users')->with('success', __('User is approved.'));
    }
}
