<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

use App\Models\Country;
use App\Models\Profile;
use App\Models\UserTitle;

use Newsletter;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Flash;
use Junaidnasir\Larainvite\Facades\Invite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm($code = null)
    {
        $countries = Country::whereNull('deleted_at')->get();

        return view('auth.register')->with('countries', $countries)->with('code', $code);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'lastname' => ['string', 'max:255'],
            'phone' => ['min:11', 'numeric'],
            'country' => ['string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $code = $data['code'];
        $parent_id = 0;
        if( Invite::isValid($code)) {
            $invitation = Invite::get($code);
            $referral_user = $invitation->user;
            $parent_id = $referral_user->id;

            $parent = User::with(['titles' => function ($q) {
                $q->orderBy('id', 'desc');
            }])->find($parent_id);

            if ( $parent ) {
                $children = User::where('parent_id', $parent_id)->with(['titles' => function ($q) {
                    $q->orderBy('id', 'desc');
                }])->get();

                if ( count($parent->titles) == 0 ) {
                    if (count($children) >= 20) {
                        $newTitle = new UserTitle();
                        $newTitle->user_id = $parent_id;
                        $newTitle->title_id = 1;
                        $newTitle->save();
                    }
                } else {
                    $childLeader = 0;
                    $childExecutive = 0;
                    foreach($children as $child) {
                        if ( count( $child->titles ) > 0 && $child->titles[0]->title->name == 'TEAM LEADER' ) {
                            $childLeader++;
                        }
                        if ( count( $child->titles ) > 0 && $child->titles[0]->title->name == 'EXECUTIVE LEADER' ) {
                            $childExecutive++;
                        }
                    }

                    if ($childExecutive >= 20) {
                        $newTitle = new UserTitle();
                        $newTitle->user_id = $parent_id;
                        $newTitle->title_id = 3;
                        $newTitle->save();
                    } else if ($childLeader >= 20) {
                        $newTitle = new UserTitle();
                        $newTitle->user_id = $parent_id;
                        $newTitle->title_id = 2;
                        $newTitle->save();
                    }
                }
            }
        } else {
            $status = Invite::status($code);
        }

        $email = $data['email'];
        if( Invite::isAllowed($code, $email) ){
            // Register this user
            Invite::consume($code);
        }

        $role = Role::where('slug', '=', 'unverified')->first();
        $country = Country::where('id', $data['country'])->first();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'country' => $country->name,
            'is_active' => 1,
            'parent_id' => $parent_id
        ]);

        $profile = new Profile();
        $profile->country_id = $data['country'];
        $user->profile()->save($profile);
        $user->attachRole($role);

        Newsletter::subscribe($data['email'], [
            'FNAME' => $data['name'],
            'LNAME' => $data['lastname'],
            'PHONE' => $data['phone']
        ]);

        return $user;
    }

    public function register(Request $request)
    {
        $requestData = $request->all();
        $this->validator($requestData)->validate();

        //Determine User type
        event(new Registered($user = $this->create($requestData)));

        \Auth::logout();

        return redirect('/login')->with('message', __('Thank you for registering! Please verify your email to browse the website.'));
        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }
}
