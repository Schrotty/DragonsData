<?php

namespace App\Policies;

use App\Models\Ocean;
use App\Models\User;

/**
 * Class ContinentPolicy
 * @package App\Policies
 */
class OceanPolicy extends Policy
{

    /**
     * @param User $oUser
     * @param Ocean $oOcean
     * @return bool
     */
    public function edit(User $oUser, Ocean $oOcean)
    {
        return $oUser->id == $oOcean->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param Ocean $oOcean
     * @return bool
     */
    public function see(User $oUser, Ocean $oOcean)
    {
        if ($oUser->id == $oOcean->realm->dungeonMaster->id) {
            return true;
        }

        return $oOcean->knownByUser($oUser) || $oOcean->isOpenRealm();
    }
}