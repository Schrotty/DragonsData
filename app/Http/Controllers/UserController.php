<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * @param $userid
     * @param $realm
     * @return mixed
     */
    public function isAssignedToRealm($userid, $realm)
    {
        return $realm->users->find($userid);
    }
}