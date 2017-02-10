<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 10.02.2017
 * Time: 19:50
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @var string
     */
    protected $table = "tag";

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}