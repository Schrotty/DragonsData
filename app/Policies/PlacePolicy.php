<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\Place;
use App\Models\User;

class PlacePolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Place $oPlace
     * @return bool
     */
    public function edit(User $oUser, Place $oPlace)
    {
        return $oUser->id == $oPlace->landscape->continent->realm->gamemaster->id;
    }

    /**
     * @param User $oUser
     * @param Place $oPlace
     * @return bool
     */
    public function see(User $oUser, Place $oPlace)
    {
        if ($oUser->id == $oPlace->landscape->continent->realm->gamemaster->id) {
            return true;
        }

        return $oPlace->knownByUser($oUser);
    }
}