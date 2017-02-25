<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * @property mixed users
 * @property mixed description
 * @property mixed dungeonMaster
 * @property mixed isOpen
 * @property mixed url
 * @property mixed name
 * @property mixed shortDescription
 * @property mixed fk_creator
 * @property mixed fk_dungeonMaster
 */
class Realm extends BaseModel
{
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'realm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'shortDescription', 'isPrivate', 'fk_dungeonMaster', 'fk_creator', 'isOpen', 'url'
    ];

    /**
     * @param $oRealm
     * @return mixed
     */
    public static function continents($oRealm)
    {
        return Realm::find($oRealm->id)->hasMany('App\Models\Continent', 'fk_realm', 'id')->get();
    }

    /**
     * @param $oRealm
     * @return mixed
     */
    public static function oceans($oRealm)
    {
        return Realm::find($oRealm->id)->hasMany('App\Models\Ocean', 'fk_realm', 'id')->get();
    }

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->dungeonMaster();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dungeonMaster()
    {
        return $this->hasOne('App\Models\User', 'id', 'fk_dungeonMaster');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'fk_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownRealm', 'fk_realm', 'fk_user');
    }

    /**
     * @return $this
     */
    public function realm()
    {
        return $this;
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function isDungeonMaster(User $oUser)
    {
        return $this->dungeonMaster->id == $oUser->id;
    }

    /**
     * @param $oUser
     * @return bool
     */
    public function knownByUser($oUser)
    {
        return parent::knownByUser($oUser) || $this->dungeonMaster->id == $oUser->id;
    }

    /**
     * @return mixed
     */
    public function inOpenRealm()
    {
        return $this->isOpen;
    }
}