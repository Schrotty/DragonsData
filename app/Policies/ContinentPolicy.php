<?php

namespace App\Policies;

use App\Models\Continent;
use App\Models\User;

/**
 * Class ContinentPolicy
 * @package App\Policies
 */
class ContinentPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Continent $oContinent
     * @return bool
     */
    public function edit(User $oUser, Continent $oContinent)
    {
        return $oUser->id == $oContinent->realm->gamemaster->id;
    }

    /**
     * @param User $oUser
     * @param Continent $oContinent
     * @return bool
     */
    public function known(User $oUser, Continent $oContinent)
    {
        if ($oUser->id == $oContinent->realm->gamemaster->id) {
            return true;
        }

        return $oUser->id == $oContinent->knownByUser($oUser)->id;
    }
}