<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed users
 * @property mixed gamemaster
 */
class Realm extends Model
{
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
        return $this->hasOne('App\User', 'id', 'fk_creator');
    }

    public function knownByUser($user)
    {
        $oUser = $this->knownBy()->find($user->id);
        if ($oUser == null)
        {
            return new User();
        }

        return $oUser;
    }

    public function knownBy()
    {
        return $this->belongsToMany('App\User', 'knownRealm', 'fk_realm', 'fk_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function continents()
    {
        return $this->hasMany('App\Continent', 'fk_realm', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gamemaster()
    {
        return $this->hasOne('App\User', 'id', 'fk_gamemaster');
    }
}