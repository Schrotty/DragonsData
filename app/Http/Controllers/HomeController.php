<?php

namespace App\Http\Controllers;

use App\User;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $realms = User::find(Auth::user()->id)->realms;

        return view('home', ['realms' => $realms]);
    }
}