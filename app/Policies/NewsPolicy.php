<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
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

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user)
    {
        return $user->isMember();
    }

    public function update(User $user) {
        return $user->isAdmin();
    }

    public function delete(User $user) {
        return $user->isAdmin();
    }
}
