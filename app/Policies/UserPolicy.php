<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 17:39
 */

namespace App\Policies;

use App\Models\User;

class UserPolicy extends Policy
{
    /**
     * @param User $oUser
     * @return mixed
     */
    public function isDungeonMaster(User $oUser)
    {
        return $oUser->isDungeonMaster;
    }

    /**
     * @param User $oUser
     * @param User $oCheckUser
     * @return bool
     */
    public function see(User $oUser, User $oCheckUser)
    {
        return true; //Users are public objects
    }
}