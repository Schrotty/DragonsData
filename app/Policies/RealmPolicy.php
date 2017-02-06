<?php

namespace App\Policies;

use App\Models\Realm;
use App\Models\User;

/**
 * Class RealmPolicy
 * @package App\Policies
 */
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

    /**
     * @param User $oUser
     * @param Realm $oRealm
     * @return bool
     */
    public function known(User $oUser, Realm $oRealm)
    {
        return $oUser->id == $oRealm->knownByUser($oUser)->id;
    }
}