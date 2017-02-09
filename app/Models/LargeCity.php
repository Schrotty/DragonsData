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
 * @property mixed landscape
 * @property mixed description
 */
class LargeCity extends BaseModel implements IModel
{
    /**
     * @var string
     */
    protected $table = "largeCity";

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
        return $this->belongsToMany('App\Models\User', 'knownLargeCity', 'fk_largeCity', 'fk_user');
    }
}