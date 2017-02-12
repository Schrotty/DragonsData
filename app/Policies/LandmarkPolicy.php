<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\Landmark;
use App\Models\User;

class LandmarkPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Landmark $oLandmark
     * @return bool
     */
    public function edit(User $oUser, Landmark $oLandmark)
    {
        return $oUser->id == $oLandmark->landscape->continent->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param Landmark $oLandmark
     * @return bool
     */
    public function see(User $oUser, Landmark $oLandmark)
    {
        if ($oUser->id == $oLandmark->landscape->continent->realm->dungeonMaster->id) {
            return true;
        }

        return $oLandmark->knownByUser($oUser) || $oLandmark->isOpenRealm();
    }
}