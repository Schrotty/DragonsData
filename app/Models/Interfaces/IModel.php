<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 16:00
 */

namespace App\Models\Interfaces;

use App\Models\User;

interface IModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy();

    /**
     * @param User $oUser
     * @return mixed
     */
    public function isRealmMaster(User $oUser);

    /**
     * @return mixed
     */
    public function isOpenRealm();
}