<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 16:00
 */

namespace App\Models\Interfaces;

interface IModel
{
    /**
     * @param $oUser
     * @return mixed
     */
    public function knownByUser($oUser);

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy();

    /**
     * @return mixed
     */
    public function formatDescription();
}