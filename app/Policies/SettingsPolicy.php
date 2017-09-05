<?php

namespace App\Policies;

use App\Settings;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingsPolicy
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
        return $user->isAdmin();
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

    public function delete(User $user)
    {
        //
    }
}