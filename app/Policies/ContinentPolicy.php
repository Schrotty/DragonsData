<?php

namespace App\Policies;

use App\Continent;
use App\User;

class ContinentPolicy extends Policy
{
    public function edit(User $oUser, Continent $oContinent)
    {
        return $oUser->id == $oContinent->realm->gamemaster->id;
    }

    public function known(User $oUser, Continent $oContinent)
    {
        if ($oUser->id == $oContinent->realm->gamemaster->id) {
            return true;
        }

        return $oUser->id == $oContinent->knownByUser($oUser)->id;
    }
}