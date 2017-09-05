<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if($user->isAdmin()) return true;
    }

    public function create(User $user)
    {
        //
    }

    public function view(User $user)
    {
        //
    }

    public function update(User $user)
    {
        //
    }

    public function delete(User $user, $meta)
    {
        return !$meta->protected && $user->isRoot();
    }
}