<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\River;
use App\Models\User;

class RiverPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param River $oRiver
     * @return bool
     */
    public function edit(User $oUser, River $oRiver)
    {
        return $oUser->id == $oRiver->landscape->continent->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param River $oRiver
     * @return bool
     */
    public function see(User $oUser, River $oRiver)
    {
        if ($oUser->id == $oRiver->landscape->continent->realm->dungeonMaster->id) {
            return true;
        }

        return $oRiver->knownByUser($oUser) || $oRiver->isOpenRealm();
    }
}