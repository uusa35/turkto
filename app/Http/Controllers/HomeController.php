<?php

namespace App\Http\Controllers;

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
        $user = User::where('secret', bcrypt($token))->first();

        if ($user) {
            $user->update(['active' => true]);
            return redirect()->home()->with('success', 'u are activated');
        }

        return redirect()->home()->with('error', 'your account still not activated .. please check with the administrator');
    }
}
