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

/**
 * Class SmallCity
 * @property mixed description
 * @property mixed landscape
 * @package App\Models
 */
class City extends BaseModel implements IModel
{

    public $sParentModel = 'Landscape';
    /**
     * @var string
     */
    protected $table = "city";

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

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'cityTag', 'fk_city', 'fk_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownCity', 'fk_city', 'fk_user');
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
    public function isOpenRealm()
    {
        return $this->landscape->continent->realm->isOpen;
    }
}