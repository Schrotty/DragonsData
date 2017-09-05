<?php

namespace App\Policies;


use App\Journal;
use App\Party;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JournalPolicy
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

    public function view(User $user, Journal $journal)
    {
        //
    }

    public function update(User $user, Journal $journal)
    {
        return Party::find($journal->party)->first()->chronist == $user->_id;
    }

    public function delete(User $user, Journal $journal)
    {
        return Party::find($journal->party)->first()->creator == $user->_id;
    }
}