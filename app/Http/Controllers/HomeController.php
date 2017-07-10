<?php

namespace App\Http\Controllers;

use App\Notifications\UserActivate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        $user = User::where('secret', $token)->first();
        $diff = Carbon::parse($user->created_at)->diffInMinutes(Carbon::now('Asia/Kuwait'));

        if ($user && $diff <= 10) {
            $user->whereId($user->id)->update(['active' => 1]);
            return redirect()->home()->with('success', 'u are activated');
        }
        return redirect()->route('resend')->with('warning', 'your activiation is expired .. please resend again');
    }

    public function getResendActivation()
    {
        return view('frontend.modules.user.activate');
    }

    public function postResendActivation(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->notify(new UserActivate($user));
            return redirect()->home()->with('success', 'email is sent');
        } else {
            return redirect()->home()->with('error', 'no such email in our db');
        }
    }
}
