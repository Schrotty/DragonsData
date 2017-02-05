<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Landscape;
use App\User;

class LandscapePolicy extends Policy
{
    public function edit(User $oUser, Landscape $oLandscape)
    {
        return $oUser->id == $oLandscape->continent->realm->gamemaster->id;
    }

    public function known(User $oUser, Landscape $oLandscape)
    {
        if ($oUser->id == $oLandscape->continent->realm->gamemaster->id) {
            return true;
        }

        return $oUser->id == $oLandscape->knownByUser($oUser)->id;
    }
}