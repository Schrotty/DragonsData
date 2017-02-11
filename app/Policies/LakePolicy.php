<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\Lake;
use App\Models\User;

class LakePolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Lake $oLake
     * @return bool
     */
    public function edit(User $oUser, Lake $oLake)
    {
        return $oUser->id == $oLake->landscape->continent->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param Lake $oLake
     * @return bool
     */
    public function see(User $oUser, Lake $oLake)
    {
        if ($oUser->id == $oLake->landscape->continent->realm->dungeonMaster->id) {
            return true;
        }

        return $oLake->knownByUser($oUser) || $oLake->isOpenRealm();
    }
}