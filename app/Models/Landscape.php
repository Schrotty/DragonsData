<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:02
 */

namespace App\Models;

use App\Models\Base\BaseModel;
use App\Models\Interfaces\IModel;

/**
 * @property mixed continent
 */
class Landscape extends BaseModel implements IModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'landscape';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function largeCities()
    {
        return $this->hasMany('App\Models\LargeCity', 'fk_landscape', 'id')->get();
    }

    /**
     * @return array
     */
    public function mediumCities()
    {
        return $this->hasMany('App\Models\MediumCity', 'fk_landscape', 'id')->get();
    }

    /**
     * @return array
     */
    public function smallCities()
    {
        return $this->hasMany('App\Models\SmallCity', 'fk_landscape', 'id')->get();
    }

    /**
     * @return mixed
     */
    public function places()
    {
        return $this->hasMany('App\Models\Place', 'fk_landscape', 'id')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function continent()
    {
        return $this->hasOne('App\Models\Continent', 'id', 'fk_continent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownLandscape', 'fk_landscape', 'fk_user');
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function isRealmMaster(User $oUser)
    {
        return $this->continent->realm->dungeonMaster->id == $oUser->id;
    }
}