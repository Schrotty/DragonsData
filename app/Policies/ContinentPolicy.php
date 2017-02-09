<?php

namespace App\Policies;

use App\Models\Continent;
use App\Models\User;

/**
 * Class ContinentPolicy
 * @package App\Policies
 */
class ContinentPolicy extends Policy
{
    /**
     * @param User $oUser
     * @return bool
     */
    public function create(User $oUser)
    {
        return $oUser->isDungeonMaster || $oUser->isAdmin || $oUser->isRootAdmin;
    }

    /**
     * @param User $oUser
     * @param Continent $oContinent
     * @return bool
     */
    public function edit(User $oUser, Continent $oContinent)
    {
        return $oUser->id == $oContinent->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param Continent $oContinent
     * @return bool
     */
    public function see(User $oUser, Continent $oContinent)
    {
        if ($oUser->id == $oContinent->realm->dungeonMaster->id) {
            return true;
        }

        return $oContinent->knownByUser($oUser) || $oContinent->isOpenRealm();
    }
}