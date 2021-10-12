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
        $subscriptions = DB::table('subscriptions')->select('subscriptions.*', 'plans.title', 'users.id as user_id', 'users.name', 'users.lastname')
                            ->leftJoin('plans', 'subscriptions.plan_id', '=', 'plans.id')
                            ->leftJoin('users', 'subscriptions.user_id', '=', 'users.id')
                            ->whereNull('subscriptions.deleted_at')
                            ->whereNull('plans.deleted_at')
                            ->paginate(10);

        return view('subscriptions.index')
                    ->with('subscriptions', $subscriptions);
    }

    public function commissions($user_id)
    {
        $commissions = DB::table('commissions')
                        ->leftJoin('users as sender', 'commissions.user_id', '=', 'sender.id')
                        ->leftJoin('users as receiver', 'commissions.receiver_id', '=', 'receiver.id')
                        ->select('commissions.*', 'sender.name as sender_name', 'sender.lastname as sender_lastname', 'receiver.name as receiver_name', 'receiver.lastname as receiver_lastname')
                        ->where('commissions.receiver_id', $user_id)
                        ->orderBy('commissions.id', 'desc')
                        ->get();

        $user = User::find($user_id);

        return view('subscriptions.commission')
                    ->with('commissions', $commissions)
                    ->with('user', $user);
    }
}
