<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Gate::allows('view-users')){
            return view('users', ['users' => User::all()]);
        }

        return view('errors.503');
    }

    /**
     * @param $iUserID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iUserID)
    {
        return view('user', ['user' => User::find($iUserID)]);
    }

    /**
     * @param $userid
     * @param $realm
     * @return mixed
     */
    public function isAssignedToRealm($userid, $realm)
    {
        return $realm->users->find($userid);
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        return $id . " : Done!";
    }
}