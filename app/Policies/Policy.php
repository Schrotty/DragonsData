<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 20:06
 */

namespace App\Policies;

use App\Models\User;

class Policy
{
    /**
     * @param User $oUser
     * @return bool
     */
    public function before(User $oUser)
    {
        if ($oUser->isRootAdmin) return true;
    }
}