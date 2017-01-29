<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 20:06
 */

namespace App\Policies;

use App\User;

class Policy
{
    public function before(User $oUser)
    {
        if ($oUser->isAdmin) return true;
    }
}