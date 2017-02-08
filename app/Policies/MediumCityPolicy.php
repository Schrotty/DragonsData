<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\MediumCity;
use App\Models\User;

class MediumCityPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param MediumCity $oMediumCity
     * @return bool
     */
    public function edit(User $oUser, MediumCity $oMediumCity)
    {
        return $oUser->id == $oMediumCity->landscape->continent->realm->gamemaster->id;
    }

    /**
     * @param User $oUser
     * @param MediumCity $oMediumCity
     * @return bool
     */
    public function see(User $oUser, MediumCity $oMediumCity)
    {
        if ($oUser->id == $oMediumCity->landscape->continent->realm->gamemaster->id) {
            return true;
        }

        return $oMediumCity->knownByUser($oUser);
    }
}