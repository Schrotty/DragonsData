<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 16:52
 */

namespace App\Models;

/**
 * Class Log
 * @package App\Models
 */
class Log
{
    /**
     * @var string
     */
    protected $table = "log";

    /**
     * @var array
     */
    protected $fillable = [
        'event', 'description'
    ];
}