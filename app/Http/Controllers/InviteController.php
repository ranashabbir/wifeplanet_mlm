<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Invitation;
use Junaidnasir\Larainvite\Facades\Invite;
use App\Mail\MarkdownMail;

use App\Models\User;
use App\Models\Title;

use Auth;
use Mail;
use Flash;

class InviteController extends Controller
{
    public function index()
    {
        return view('invites.index');
    }

    public function my()
    {
        $user = User::with(['children' => function ($q) {
            $q->orderBy('id', 'desc');
        }])->find(Auth::user()->id);

        return view('invites.my')->with('user', $user);
    }

    public function mynetworks()
    {
        $user = User::with(['children' => function ($q) {
            $q->orderBy('id', 'desc');
        }])->find(Auth::user()->id);

        return view('networks.my')->with('user', $user);
    }

    public function invite(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ],
        [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return redirect(route('invite.invite'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $emails = $request->input('email');
        $emails = explode(',', $emails);
        foreach( $emails as $email ) {
            $code = Invite::invite($email, $user->id);

            $data['email'] = $user->email;
            $data['code'] = $code;
            $data['name'] = $user->name . ' ' . $user->lastname;
            $data['url'] = url('/register/'.$code);
            $data['header_text'] = config('app.name', 'Laravel') . ' Invitation';
            $data['header_url'] = url('/');

            try {
                Mail::to($email)
                    ->send(new MarkdownMail('mail.invite', config('app.name', 'Laravel') . ' Invitation', $data));

            } catch (Exception $e) {
                throw new Exception('Invitation record added, but unable to send email');
            }
        }

        Flash::success('Invites sent successfully.');
        return redirect()->back();
    }

    public function titles()
    {
        $titles = Title::all();

        return view('titles.index')->with('titles', $titles);
    }

    public function mytitles()
    {
        $user = User::with('titles')->where('id', Auth::user()->id)->first();

        return view('titles.my')->with('user', $user);
    }
}
