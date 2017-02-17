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
        'name', 'shortDescription', 'description', 'fk_continent', 'url'
    ];

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->continent();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function continent()
    {
        return $this->hasOne('App\Models\Continent', 'id', 'fk_continent');
    }

    /**
     * @return array
     */
    public function cities()
    {
        return $this->hasMany('App\Models\City', 'fk_landscape', 'id')->get();
    }

    /**
     * @return array
     */
    public function rivers()
    {
        return $this->hasMany('App\Models\River', 'fk_landscape', 'id')->get();
    }

    /**
     * @return array
     */
    public function lakes()
    {
        return $this->hasMany('App\Models\Lake', 'fk_landscape', 'id')->get();
    }

    /**
     * @return array
     */
    public function biomes()
    {
        return $this->hasMany('App\Models\Biome', 'fk_landscape', 'id')->get();
    }

    /**
     * @return array
     */
    public function landmarks()
    {
        return $this->hasMany('App\Models\Landmark', 'fk_landscape', 'id')->get();
    }

    /**
     * @return array
     */
    public function mountains()
    {
        return $this->hasMany('App\Models\Mountain', 'fk_landscape', 'id')->get();
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

    /**
     * @return mixed
     */
    public function isOpenRealm()
    {
        return $this->continent->realm->isOpen;
    }
}