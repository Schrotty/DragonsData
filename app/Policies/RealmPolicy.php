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
    public function see(User $oUser, Realm $oRealm)
    {
        return $oRealm->knownByUser($oUser) || $oRealm->isOpen || $oRealm->isRealmMaster($oUser);
    }

    /**
     * @param User $oUser
     * @param Realm $oRealm
     * @return bool
     */
    public function edit(User $oUser, Realm $oRealm)
    {
        return $oUser->id === $oRealm->dungeonMaster->id;
    }
}