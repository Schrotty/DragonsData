<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\LargeCity;
use App\Models\User;

class LargeCityPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param LargeCity $oLargeCity
     * @return bool
     */
    public function edit(User $oUser, LargeCity $oLargeCity)
    {
        return $oUser->id == $oLargeCity->landscape->continent->realm->gamemaster->id;
    }

    /**
     * @param User $oUser
     * @param LargeCity $oLargeCity
     * @return bool
     */
    public function see(User $oUser, LargeCity $oLargeCity)
    {
        if ($oUser->id == $oLargeCity->landscape->continent->realm->gamemaster->id) {
            return true;
        }

        return $oLargeCity->knownByUser($oUser);
    }
}