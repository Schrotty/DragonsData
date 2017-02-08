<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\SmallCity;
use App\Models\User;

class SmallCityPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param SmallCity $oSmallCity
     * @return bool
     */
    public function edit(User $oUser, SmallCity $oSmallCity)
    {
        return $oUser->id == $oSmallCity->landscape->continent->realm->gamemaster->id;
    }

    /**
     * @param User $oUser
     * @param SmallCity $oSmallCity
     * @return bool
     */
    public function see(User $oUser, SmallCity $oSmallCity)
    {
        if ($oUser->id == $oSmallCity->landscape->continent->realm->gamemaster->id) {
            return true;
        }

        return $oSmallCity->knownByUser($oUser);
    }
}