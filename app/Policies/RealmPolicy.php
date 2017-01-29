<?php

namespace App\Policies;

use App\Realm;
use App\User;

class RealmPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Realm $oRealm
     * @return bool
     */
    public function edit(User $oUser, Realm $oRealm)
    {
        return $oUser->id === $oRealm->gamemaster->id;
    }

    public function known(User $oUser, Realm $oRealm)
    {
        return $oUser->id == $oRealm->knownByUser($oUser)->id;
    }
}