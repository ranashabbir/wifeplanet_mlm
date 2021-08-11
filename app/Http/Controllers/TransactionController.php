<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Transaction;

use Flash;
use Auth;
use DB;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $withdrawn = \DB::table("transactions")
                ->select(\DB::raw("SUM(amount) as withdrawn"))
                ->where('type', "withdraw")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $purchase = \DB::table("transactions")
                ->select(\DB::raw("SUM(amount) as purchase"))
                ->where('type', "purchase")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $bonus = DB::table("transactions")
                ->select(DB::raw("SUM(amount) as bonus"))
                ->where('type', "commission")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $deposit = DB::table("transactions")
                ->select(DB::raw("SUM(amount) as deposit"))
                ->where('type', "deposit")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $transactions = DB::table('transactions')
                        ->leftJoin('users', 'transactions.from', '=', 'users.id')
                        ->select('transactions.*', 'users.name', 'users.lastname')
                        ->where('transactions.user_id', $user->id)
                        ->orderBy('transactions.id', 'desc')
                        ->get()
        ;

        return view('transactions.index')
                    ->with('transactions', $transactions)
                    ->with('user', $user)
                    ->with('withdrawn', $withdrawn ? $withdrawn->withdrawn : '0.00')
                    ->with('purchase', $purchase ? $purchase->purchase : '0.00')
                    ->with('deposit', $deposit ? $deposit->deposit : '0.00')
                    ->with('bonus', $bonus ? $bonus->bonus : '0.00')
        ;
    }

    public function deposit()
    {
        $user = Auth::user();

        $withdrawn = \DB::table("transactions")
                ->select(\DB::raw("SUM(amount) as withdrawn"))
                ->where('type', "withdraw")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $purchase = \DB::table("transactions")
                ->select(\DB::raw("SUM(amount) as purchase"))
                ->where('type', "purchase")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $bonus = DB::table("transactions")
                ->select(DB::raw("SUM(amount) as bonus"))
                ->where('type', "commission")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $deposit = DB::table("transactions")
                ->select(DB::raw("SUM(amount) as deposit"))
                ->where('type', "deposit")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        return view('transactions.deposit')
            ->with('withdrawn', $withdrawn ? $withdrawn->withdrawn : '0.00')
            ->with('purchase', $purchase ? $purchase->purchase : '0.00')
            ->with('deposit', $deposit ? $deposit->deposit : '0.00')
            ->with('bonus', $bonus ? $bonus->bonus : '0.00')
        ;
    }

    public function withdraw()
    {
        $user = Auth::user();

        $withdrawn = \DB::table("transactions")
                ->select(\DB::raw("SUM(amount) as withdrawn"))
                ->where('type', "withdraw")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $purchase = \DB::table("transactions")
                ->select(\DB::raw("SUM(amount) as purchase"))
                ->where('type', "purchase")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $bonus = DB::table("transactions")
                ->select(DB::raw("SUM(amount) as bonus"))
                ->where('type', "commission")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        $deposit = DB::table("transactions")
                ->select(DB::raw("SUM(amount) as deposit"))
                ->where('type', "deposit")
                ->where('user_id', $user->id)
                ->groupBy('user_id')
                ->first();

        return view('transactions.withdraw')
            ->with('withdrawn', $withdrawn ? $withdrawn->withdrawn : '0.00')
            ->with('purchase', $purchase ? $purchase->purchase : '0.00')
            ->with('deposit', $deposit ? $deposit->deposit : '0.00')
            ->with('bonus', $bonus ? $bonus->bonus : '0.00')
        ;
    }

    public function withdrawal()
    {
        $withdrawal = Transaction::with('user')->where('type', 'withdraw')->orderBy('id', 'desc')->get();
        return view('transactions.withdrawal')->with('withdrawal', $withdrawal);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => $request->input('type') == 'deposit' ? 'required|integer|min:1' : 'required|integer|min:50',
            'type' => 'required',
        ],
        [
            'required' => 'The :attribute field is required.',
            'integer' => 'The :attribute field must be number.',
            'min' => 'The :attribute value :input must be greater then :min.',
        ]);

        if ($validator->fails()) {
            return redirect(route('transactions.' . $request->input('type')))
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->input('type') == 'withdraw' && $request->input('amount') > $request->input('available')) {
            Flash::error('Entered amount exceeds available amount.');
            $validator->getMessageBag()->add('amount', 'Entered amount exceeds available amount.');
            return redirect(route('transactions.' . $request->input('type')))
                        ->withErrors($validator)
                        ->withInput();
        }

        if (!Auth::user()) {
            return redirect('/login');
        }

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->amount = $request->input('amount');
        $transaction->type = $request->input('type');
        $transaction->status = 'pending';
        $transaction->save();

        Flash::success('Your request has been sent.');
        return redirect(route('transactions'));
    }

    public function processrequest($id, $type)
    {
        if (!$id) {
            Flash::error('Withdrawal request id not found.');
            return redirect()->back();
        }

        if (!$type) {
            Flash::error('Withdrawal request type not found.');
            return redirect()->back();
        }

        $transaction = Transaction::find($id);

        if (!$transaction) {
            Flash::error('Withdrawal request not found.');
            return redirect()->back();
        }

        $transaction->update(["status" => $type]);
        
        Flash::success('Withdrawal request processed.');
        return redirect(route('transactions.withdrawal'));
    }
}
