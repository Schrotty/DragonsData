<?php

namespace App\Policies;

use App\Item;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
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

    /**
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if($user->isRoot()) return true;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Item $item)
    {
        return $item->hasReadPrivileges($user);
    }

    public function update(User $user, Item $item) {
        return $item->hasWritePrivileges($user) || $user->isAdmin();
    }

    public function delete(User $user, Item $item) {
        return $item->hasDeletePrivileges($user) || $user->isAdmin();
    }
}
