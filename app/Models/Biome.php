<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 16:52
 */

namespace App\Models;

use App\Models\Base\BaseModel;
use App\Models\Interfaces\IModel;
use Elasticquent\ElasticquentTrait;

/**
 * Class SmallCity
 * @property mixed description
 * @property mixed landscape
 * @package App\Models
 */
class Biome extends BaseModel implements IModel
{

    use ElasticquentTrait;

    /**
     * @var string
     */
    protected $table = "biome";

    /**
     * @var array
     */
    protected $fillable = [
        'description', 'shortDescription', 'name', 'fk_landscape', 'url'
    ];

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->landscape();
    }

    /**
     * @return mixed
     */
    public function landscape()
    {
        return $this->hasOne('App\Models\Landscape', 'id', 'fk_landscape');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'biomeTag', 'fk_biome', 'fk_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownBiome', 'fk_biome', 'fk_user');
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