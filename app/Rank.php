<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 27.01.2017
 * Time: 18:50
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}