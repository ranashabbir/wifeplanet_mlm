<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Commission;
use App\Models\User;
use Auth;
use DB;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();

        return view('subscriptions.index')
                    ->with('subscriptions', $subscriptions);
    }

    public function commissions($user_id)
    {
        $commissions = DB::table('commissions')
                        ->leftJoin('users as sender', 'commissions.user_id', '=', 'sender.id')
                        ->leftJoin('users as receiver', 'commissions.receiver_id', '=', 'receiver.id')
                        ->select('commissions.*', 'sender.name as sender_name', 'sender.lastname as sender_lastname', 'receiver.name as receiver_name', 'receiver.lastname as receiver_lastname')
                        ->where('commissions.user_id', $user_id)
                        ->get();

        $user = User::find($user_id);

        return view('subscriptions.commission')
                    ->with('commissions', $commissions)
                    ->with('user', $user);
    }
}
