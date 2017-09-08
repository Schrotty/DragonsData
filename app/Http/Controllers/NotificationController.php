<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Item;
use App\News;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return \view('notifications', ['notifications' => Auth::user()->getValue('unreadNotifications', array())]);
    }

    public function show($notification)
    {
        foreach (Auth::user()->getValue('unreadNotifications', array()) as $not) {
            if($notification == $not->id){
                $not->delete();
            }
        }

        return redirect('/notification');
    }
}