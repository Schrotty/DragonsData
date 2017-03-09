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
use Elasticquent\ElasticquentTrait;

/**
 * @property mixed sea
 * @property mixed parent
 */
class Island extends BaseModel implements IModel
{
    use ElasticquentTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'island';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'fk_sea', 'shortDescription', 'description', 'url'
    ];

    /**
     * @param $oIsland
     * @return mixed
     */
    public static function landscapes($oIsland)
    {
        return Island::find($oIsland->id)->hasMany('App\Models\Landscape', 'fk_island', 'id')->get();
    }

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->sea();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sea()
    {
        return $this->hasOne('App\Models\Sea', 'id', 'fk_sea');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownIsland', 'fk_island', 'fk_user');
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function isRealmMaster(User $oUser)
    {
        return $this->sea->ocean->realm->dungeonMaster->id == $oUser->id;
    }

    /**
     * @return mixed
     */
    public function isOpenRealm()
    {
        return $this->sea->ocean->realm->isOpen;
    }

    /**
     * @return mixed
     */
    public function inOpenRealm()
    {
        return $this->sea->ocean->realm->isOpen;
    }
}