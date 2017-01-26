<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users', ['users' => User::all()]);
    }

    public function single($singleUser)
    {
        return view('user', ['user' => User::find($singleUser)]);
    }

    public function isAssignedToRealm($userid, $realm)
    {
        return $realm->users->find($userid);
    }

    public function delete($id)
    {
        return $id . " : Done!";
    }
}