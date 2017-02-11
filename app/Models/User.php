<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property mixed id
 * @property mixed isRootAdmin
 * @property mixed realms
 * @property mixed isAdmin
 * @property mixed isDungeonMaster
 * @property mixed isGameMaster
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $dates = ['created_at', 'updated_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'isAdmin', 'is_dungeonmaster'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return bool
     */
    public function hasRealms()
    {
        return count($this->realms) >= 1 ? true : false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rank()
    {
        return $this->hasOne('App\Models\Rank', 'id', 'fk_rank');
    }

    /**
     * @return string
     */
    public function username()
    {
        return "name";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function knownRealms()
    {
        if ($this->isRootAdmin()) {
            return Realm::all();
        }

        return $this->masterRealms()->merge($this->assignedRealms());
    }

    /**
     * @return mixed
     */
    public function isRootAdmin()
    {
        return $this->isRootAdmin;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function masterRealms()
    {
        return $this->hasMany('App\Models\Realm', 'fk_dungeonMaster', 'id')->getEager();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function assignedRealms()
    {
        return $this->belongsToMany('App\Models\Realm', 'knownRealm', 'fk_user', 'fk_realm')->get();
    }

    /**
     * @param $oRealm
     * @return array
     */
    public function knownContinents($oRealm)
    {
        $aResult = array();
        $aUserContinents = $this->belongsToMany('App\Models\Continent', 'knownContinent', 'fk_user', 'fk_continent')->get();
        $aRealmContinents = $oRealm->continents();

        if ($this->isRootAdmin || $oRealm->isRealmMaster($this) || $oRealm->isOpen) return $aRealmContinents;
        foreach ($aRealmContinents as $oContinent) {
            foreach ($aUserContinents as $oUserContinent) {
                if ($oContinent->id == $oUserContinent->id) $aResult[] = $oContinent;
            }
        }

        return $aResult;
    }

    /**
     * @param $oContinent
     * @return array
     */
    public function knownLandscape($oContinent)
    {
        $aResult = array();
        $aUserLandscapes = $this->belongsToMany('App\Models\Landscape', 'knownLandscape', 'fk_user', 'fk_landscape')->get();
        $aContinentLandscapes = $oContinent->landscapes();

        if ($this->isRootAdmin || $oContinent->isRealmMaster($this) || $oContinent->isOpenRealm()) return $aContinentLandscapes;
        foreach ($aContinentLandscapes as $oLandscape) {
            foreach ($aUserLandscapes as $oUserLandscape) {
                if ($oLandscape->id == $oUserLandscape->id) $aResult[] = $oLandscape;
            }
        }

        return $aResult;
    }

    /**
     * @param $oLandscape
     * @return array
     */
    public function knownCities($oLandscape)
    {
        $aResult = array();
        $aUserCities = $this->belongsToMany('App\Models\City', 'knownCity', 'fk_user', 'fk_city')->get();
        $aLandscapeCities = $oLandscape->cities();

        if ($this->isRootAdmin || $oLandscape->isRealmMaster($this) || $oLandscape->isOpenRealm()) return $aLandscapeCities;
        foreach ($aLandscapeCities as $oLandscape) {
            foreach ($aUserCities as $oUserLandscape) {
                if ($oLandscape->id == $oUserLandscape->id) $aResult[] = $oLandscape;
            }
        }

        return $aResult;
    }

    /**
     * @param $oLandscape
     * @return array
     */
    public function knownRivers($oLandscape)
    {
        $aResult = array();
        $aUserRivers = $this->belongsToMany('App\Models\River', 'knownRiver', 'fk_user', 'fk_river')->get();
        $aLandscapeRivers = $oLandscape->rivers();

        if ($this->isRootAdmin || $oLandscape->isRealmMaster($this) || $oLandscape->isOpenRealm()) return $aLandscapeRivers;
        foreach ($aLandscapeRivers as $oRiver) {
            foreach ($aUserRivers as $oUserRiver) {
                if ($oLandscape->id == $oUserRiver->id) $aResult[] = $oRiver;
            }
        }

        return $aResult;
    }
}