<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * @property mixed users
 * @property mixed description
 * @property mixed dungeonMaster
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
        'name', 'description', 'shortDescription', 'isPrivate', 'fk_gamemaster', 'fk_creator',
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function continents()
    {
        return $this->hasMany('App\Models\Continent', 'fk_realm', 'id')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dungeonMaster()
    {
        return $this->hasOne('App\Models\User', 'id', 'fk_gamemaster');
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function isRealmMaster(User $oUser)
    {
        return $this->dungeonMaster->id == $oUser->id;
    }
}