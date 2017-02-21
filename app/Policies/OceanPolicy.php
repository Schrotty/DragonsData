<?php

namespace App\Policies;

use App\Models\User;

/**
 * Class ContinentPolicy
 * @package App\Policies
 */
class OceanPolicy extends Policy
{
    /**
     * @param User $oUser
     * @param $oObject
     * @return mixed
     */
    public function view(User $oUser, $oObject)
    {
        return parent::view($oUser, $oObject);
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function edit(User $oUser)
    {
        return parent::edit($oUser);
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function create(User $oUser)
    {
        return parent::create($oUser);
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function destroy(User $oUser)
    {
        return parent::destroy($oUser);
    }
}