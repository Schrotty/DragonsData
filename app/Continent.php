<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 16:00
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'continent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    public function landscapes()
    {
        return $this->hasMany('App\Landscape', 'fk_continent', 'id');
    }

    public function realm()
    {
        return $this->hasOne('App\Realm', 'id', 'fk_realm');
    }

    public function knownByUser($user)
    {
        $oUser = $this->knownBy()->find($user->id);
        if ($oUser == null) {
            return new User();
        }

        return $oUser;
    }

    public function knownBy()
    {
        return $this->belongsToMany('App\User', 'knownContinent', 'fk_continent', 'fk_user');
    }
}