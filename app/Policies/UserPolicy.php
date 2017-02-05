<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 17:39
 */

namespace App\Policies;

use App\User;

class UserPolicy extends Policy
{
    /**
     * @param User $oUser
     * @return mixed
     */
    public function isDM(User $oUser)
    {
        return $oUser->is_dungeonmaster;
    }
}