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
        if ($oUser->rank()->is_root) return true;
    }

    /**
     * @param User $oUser
     * @param $oObject
     * @return mixed
     */
    public function view(User $oUser, $oObject)
    {
        return $oObject->knownByUser($oUser);
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function edit(User $oUser)
    {
        return $oUser->rank()->is_dungeon_master;
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function create(User $oUser)
    {
        return $oUser->rank()->is_dungeon_master;
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function destroy(User $oUser)
    {
        return $oUser->rank()->is_dungeon_master;
    }
}