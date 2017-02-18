<?php

namespace App\Policies;

use App\Models\Island;
use App\Models\User;

/**
 * Class ContinentPolicy
 * @package App\Policies
 */
class IslandPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Island $oIsland
     * @return bool
     */
    public function edit(User $oUser, Island $oIsland)
    {
        return $oUser->id == $oIsland->sea->ocean->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param Island $oIsland
     * @return bool
     */
    public function see(User $oUser, Island $oIsland)
    {
        if ($oUser->id == $oIsland->sea->ocean->realm->dungeonMaster->id) {
            return true;
        }

        return $oIsland->knownByUser($oUser) || $oIsland->isOpenRealm();
    }
}