<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class Layer
 * @package App\Models
 */
class Layer extends BaseModel
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
    protected $table = 'layer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'shortDescription', 'isPrivate', 'fk_dungeonMaster', 'fk_creator', 'isOpen', 'url'
    ];

    /**
     * @param $oLayer
     * @return mixed
     */
    public static function childObjects($oLayer)
    {
        return Layer::find($oLayer->id)->hasMany('App\Models\Realm', 'fk_layer', 'id')->orderBy('isOpen', 'desc')->get();
    }
}