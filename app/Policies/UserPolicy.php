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
}