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
use Auth;

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

    public function statistics()
    {
        $user = Auth::user();
        $customer = User::whereNull('deleted_at')->where('parent_id', '!=', '0')->get();
        $no_parent = User::whereNull('deleted_at')->where('parent_id', '0')->get();
        $upgrades = Subscription::whereNull('deleted_at')
                        ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                        ->where('status', 'active')
                        ->get();

        $withdrawn = DB::table("transactions")
                        ->select(DB::raw("SUM(amount) as withdrawn"))
                        ->where('type', "withdraw")
                        ->groupBy('user_id')
                        ->first();

        $purchase = DB::table("transactions")
                        ->select(DB::raw("SUM(amount) as purchase"))
                        ->where('type', "purchase")
                        ->groupBy('user_id')
                        ->first();

        $bonus = DB::table("transactions")
                        ->select(DB::raw("SUM(amount) as bonus"))
                        ->where('type', "commission")
                        ->groupBy('user_id')
                        ->first();

        $deposit = DB::table("transactions")
                        ->select(DB::raw("SUM(amount) as deposit"))
                        ->where('type', "deposit")
                        ->groupBy('user_id')
                        ->first();

        $top_earning = DB::table("transactions")
                        ->select('user_id', DB::raw("SUM(amount) as bonus"))
                        ->where('type', "commission")
                        ->groupBy('user_id')
                        ->orderBy('bonus', 'desc')
                        ->get();

        $titles = DB::table('user_titles')
                        ->select('titles.name as title_name', 'users.name as f_name', 'users.lastname as l_name')
                        ->leftJoin('titles', 'user_titles.title_id', '=', 'titles.id')
                        ->leftJoin('users', 'user_titles.user_id', '=', 'users.id')
                        ->get()
        ;

        return view('statistics')
                ->with('user', $user)
                ->with('upgrades', $upgrades)
                ->with('customer', $customer)
                ->with('no_parent', $no_parent)
                ->with('withdrawn', $withdrawn ? $withdrawn->withdrawn : '0.00')
                ->with('purchase', $purchase ? $purchase->purchase : '0.00')
                ->with('deposit', $deposit ? $deposit->deposit : '0.00')
                ->with('bonus', $bonus ? $bonus->bonus : '0.00')
                ->with('top_earning', $top_earning)
                ->with('titles', $titles)
        ;
    }
}
