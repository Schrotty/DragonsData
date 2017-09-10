<?php

namespace App\Http\Controllers;

use App\News;
use Igaster\LaravelTheme\Facades\Theme;
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
        //if (true) return view('maintenance');
        return view('dashboard', ['news' => News::all()->reverse()]);
    }
}
