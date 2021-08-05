<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\User;
use App\Models\Subscription;

use App\Mail\MarkdownMail;

use Mail;
use Flash;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');

        $newusers = User::whereNull('deleted_at')
                        ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                        ->whereNotNull('email_verified_at')
                        ->where('is_active', 1)
                        ->get()->count()
        ;

        $upgrades = Subscription::whereNull('deleted_at')
                        ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                        ->where('status', 'active')
                        ->get()->count()
        ;

        $freeuser = DB::table('users')
                        ->join('subscriptions', 'subscriptions.user_id', '!=', 'users.id')
                        ->where('users.created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                        ->whereNull('users.deleted_at')
                        ->get()
                        ->count()
        ;

        $freepackage = DB::table('users')
                        ->join('subscriptions', 'subscriptions.user_id', '=', 'users.id')
                        ->where('users.created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                        ->where('subscriptions.price', 0)
                        ->whereNull('users.deleted_at')
                        ->get()
                        ->count()
        ;

        $forapproval = USER::with('profile')
                ->whereNull('deleted_at')
                ->whereNull('is_active')
                ->orWhere('is_active', 0)
                ->orderBy('id', 'desc')
                ->get()
        ;

        return view('home')
                ->with('newusers', $newusers)
                ->with('upgrades', $upgrades)
                ->with('freeuser', $freeuser)
                ->with('freepackage', $freepackage)
                ->with('forapproval', $forapproval)
        ;
    }

    public function contact(Request $request)
    {
        $countries = Country::whereNull('deleted_at')->get();
        if (\Request::isMethod('post')) {
            try {
                $reqData = $request->all();
                $data['email'] = $reqData['email'];
                $data['name'] = $reqData['firstname'] . ' ' . $reqData['lastname'];
                $data['phone'] = $reqData['phone'];
                $data['message'] = $reqData['message'];
                $data['header_text'] = $data['name'] . ' Query';
                $data['header_url'] = url('/');
                Mail::to('network@wifeplanet.com')
                    ->send(new MarkdownMail('mail.contact', $data['name'] . ' Query', $data));

                Mail::to('muneebtariq1991@gmail.com')
                    ->send(new MarkdownMail('mail.contact', $data['name'] . ' Query', $data));

            } catch (Exception $e) {
                throw new Exception('Unable to send email.');
            }

            Flash::success('Query Sent.');
            return redirect()->back();
        }

        if (\Request::isMethod('get')) {
            return view('contact')->with('countries', $countries);
        }
    }
}
