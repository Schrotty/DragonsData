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
use Elasticquent\ElasticquentTrait;

/**
 * @property mixed continent
 * @property mixed landscape
 */
class Mountain extends BaseModel implements IModel
{
    use ElasticquentTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mountain';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'shortDescription', 'description', 'fk_landscape', 'url'
    ];

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->landscape();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function landscape()
    {
        return $this->hasOne('App\Models\Landscape', 'id', 'fk_landscape');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownMountain', 'fk_mountain', 'fk_user');
    }

    /**
     * @param User $oUser
     * @return bool
     */
    public function isRealmMaster(User $oUser)
    {
        return $this->landscape->continent->realm->dungeonMaster->id == $oUser->id;
    }

    /**
     * @return mixed
     */
    public function inOpenRealm()
    {
        return $this->landscape->parent->realm->isOpen;
    }
}