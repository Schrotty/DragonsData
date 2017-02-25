<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 16:00
 */

namespace App\Models;

use App\Models\Base\BaseModel;
use App\Models\Interfaces\IModel;

/**
 * @property mixed realm
 * @property array|string name
 * @property array|string shortDescription
 * @property mixed|string url
 * @property array|string fk_realm
 */
class Ocean extends BaseModel implements IModel
{
    public $sParentModel = 'Realm';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ocean';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'fk_realm', 'shortDescription', 'description', 'url'
    ];

    /**
     * @param $oOcean
     * @return mixed
     */
    public static function seas($oOcean)
    {
        return Ocean::find($oOcean->id)->hasMany('App\Models\Sea', 'fk_ocean', 'id')->get();
    }

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->realm();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function realm()
    {
        return $this->hasOne('App\Models\Realm', 'id', 'fk_realm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownOcean', 'fk_ocean', 'fk_user');
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function isRealmMaster(User $oUser)
    {
        return $this->realm->dungeonMaster->id == $oUser->id;
    }

    /**
     * @return mixed
     */
    public function inOpenRealm()
    {
        return $this->realm->isOpen;
    }
}