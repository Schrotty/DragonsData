<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 05.02.2017
 * Time: 19:36
 */

namespace App\Policies;

use App\Models\Biome;
use App\Models\User;

class BiomePolicy extends Policy
{
    /**
     * @param User $oUser
     * @param Biome $oBiome
     * @return bool
     */
    public function edit(User $oUser, Biome $oBiome)
    {
        return $oUser->id == $oBiome->landscape->continent->realm->dungeonMaster->id;
    }

    /**
     * @param User $oUser
     * @param Biome $oBiome
     * @return bool
     */
    public function see(User $oUser, Biome $oBiome)
    {
        if ($oUser->id == $oBiome->landscape->continent->realm->dungeonMaster->id) {
            return true;
        }

        return $oBiome->knownByUser($oUser) || $oBiome->isOpenRealm();
    }
}