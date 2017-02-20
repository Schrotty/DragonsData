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
 * @property mixed fk_model
 */
class Landscape extends BaseModel implements IModel
{
    public $sParentModel = 'Island';

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
        'name', 'shortDescription', 'description', 'parent_id', 'fk_model', 'url'
    ];

    /**
     * @return mixed
     */
    public function parent()
    {
        App('debugbar')->info(BasicModel::where('id', $this->fk_model)->get());

        $sModel = $this->hasOne('App\Models\BasicModel', 'id', 'fk_model')->get()->first()->model;
        return $this->hasOne($sModel, 'id', 'parent_id');
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
        //return $this->parent()->first()->realm()->first()->dungeonMaster->id == $oUser->id;
        //print_r($this->parent());
        return true;
    }

    /**
     * @return mixed
     */
    public function isOpenRealm()
    {
        //return $this->continent->realm->isOpen;
        return false;
    }
}