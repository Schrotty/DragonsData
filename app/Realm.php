<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed users
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

    public function users()
    {
        return $this->belongsToMany('App\User', 'assignedRealms', 'fk_realm', 'fk_user');
    }

    public function gamemaster()
    {
        return $this->hasOne('App\User', 'id', 'fk_gamemaster');
    }

    public function hasUser($user)
    {
        return $this->users->find($user);
    }
}