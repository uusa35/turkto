<?php

namespace App\Http\Controllers;

use App\Notifications\UserActivate;
use App\User;
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
        $this->middleware('auth');
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
        $this->middleware('guest');
        $user = User::where('secret', $token)->first();
        if ($user) {
            $user->whereId($user->id)->update(['active' => 1]);
            return redirect()->home()->with('success', 'u are activated');
        }

        return redirect()->home()->with('error', 'your account still not activated .. please check with the administrator');
    }

    public function getResendActivation()
    {
        return view('errors.activate');
    }

    public function postResendActivation(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->notify(new UserActivate($user));
        } else {
            return redirect()->home()->with('error', 'no such email in our db');
        }
    }
}
