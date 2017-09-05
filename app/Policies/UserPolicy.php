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
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        if($user->isRoot()) return true;
    }

    public function index(User $user)
    {
        return $user->isAdmin();
    }

    public function create(User $user)
    {
        //
    }

    public function view(User $user, User $vUser)
    {
        return $user->_id == $vUser->_id || $user->isAdmin();
    }

    public function update(User $user)
    {
        return Auth::user()->id == $user->_id ||
            (Auth::user()->isAdmin() && Auth::user()->authLevel() >= $user->authLevel());
    }

    public function delete(User $user) {
        return $user->isRoot();
    }
}
