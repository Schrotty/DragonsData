<?php

namespace App\Policies;

use App\Models\Sea;
use App\Models\User;

/**
 * Class ContinentPolicy
 * @package App\Policies
 */
class SeaPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Sea $oSea
     * @return bool
     */
    public function edit(User $oUser, Sea $oSea)
    {
        return $oUser->id == $oSea->ocean->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param Sea $oSea
     * @return bool
     */
    public function see(User $oUser, Sea $oSea)
    {
        if ($oUser->id == $oSea->ocean->realm->dungeonMaster->id) {
            return true;
        }

        return $oSea->ocean->knownByUser($oUser) || $oSea->ocean->isOpenRealm();
    }
}