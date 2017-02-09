<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\City;
use App\Models\User;

class CityPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param City $oCity
     * @return bool
     */
    public function edit(User $oUser, City $oCity)
    {
        return $oUser->id == $oCity->landscape->continent->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param City $oCity
     * @return bool
     */
    public function see(User $oUser, City $oCity)
    {
        if ($oUser->id == $oCity->landscape->continent->realm->dungeonMaster->id) {
            return true;
        }

        return $oCity->knownByUser($oUser) || $oCity->isOpenRealm();
    }
}