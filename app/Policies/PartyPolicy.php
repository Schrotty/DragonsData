<?php

namespace App\Policies;

use App\Item;
use App\Party;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartyPolicy
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
        if($user->isAdmin()) return true;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Party $party)
    {
        return in_array($user->_id, (array)$party->member);
    }

    public function update(User $user, Party $party) {
        return $party->creator == $user->_id;
    }

    public function delete(User $user, Party $party) {
        return $party->creator == $user->_id;
    }

    public function writeDown(User $user, Party $party)
    {
        return $party->chronist == $user->_id;
    }
}
