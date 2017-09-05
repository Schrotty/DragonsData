<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        if($user->isRoot()) return true;
    }

    public function create(User $user)
    {
        return $user->isRoot();
    }

    public function view(User $user, User $vUser)
    {
        debugbar()->info($user->_id);
        debugbar()->info($vUser->_id);
        return $user->_id == $vUser->_id || $user->isAdmin();
    }

    public function update(User $user) {
        return Auth::user()->id == $user->_id;
    }

    public function delete(User $user) {
        return $user->isRoot();
    }
}
