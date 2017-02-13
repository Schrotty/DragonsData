<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\Mountain;
use App\Models\User;

class MountainPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Mountain $oMountain
     * @return bool
     */
    public function edit(User $oUser, Mountain $oMountain)
    {
        return $oUser->id == $oMountain->landscape->continent->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param Mountain $oMountain
     * @return bool
     */
    public function see(User $oUser, Mountain $oMountain)
    {
        if ($oUser->id == $oMountain->landscape->continent->realm->dungeonMaster->id) {
            return true;
        }

        return $oMountain->knownByUser($oUser) || $oMountain->isOpenRealm();
    }
}