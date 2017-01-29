<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:02
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landscape extends Model
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
        'name', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function continent()
    {
        return $this->hasOne('App\Continent', 'id', 'fk_continent');
    }
}