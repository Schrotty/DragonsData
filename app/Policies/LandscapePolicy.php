<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\Landscape;
use App\Models\User;

class LandscapePolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Landscape $oLandscape
     * @return bool
     */
    public function edit(User $oUser, Landscape $oLandscape)
    {
        //return $oUser->id == $oLandscape->parent()->realm->dungeonMaster->id;
        return true;
    }

    /**
     * @param User $oUser
     * @param Landscape $oLandscape
     * @return bool
     */
    public function see(User $oUser, Landscape $oLandscape)
    {
        if ($oUser->id == $oLandscape->parent()->realm()->dungeonMaster->id) {
            return true;
        }

        return $oLandscape->knownByUser($oUser) || $oLandscape->isOpenRealm();
    }
}