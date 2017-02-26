<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class Layer
 * @package App\Models
 */
class Empire extends BaseModel
{
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empire';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'shortDescription', 'url', 'fk_realm'
    ];

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
        return $this->belongsToMany('App\Models\User', 'knownContinent', 'fk_continent', 'fk_user');
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
     * @param $oUser
     * @return bool
     */
    public function knownByUser($oUser)
    {
        return parent::knownByUser($oUser) || $this->realm->dungeonMaster->id == $oUser->id;
    }

    /**
     * @return mixed
     */
    public function inOpenRealm()
    {
        return $this->realm->isOpen;
    }
}