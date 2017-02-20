<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 20.02.2017
 * Time: 18:50
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rank
 * @package App\Models
 */
class Rank extends Model
{
    /**
     * @var string
     */
    protected $table = 'rank';

    /**
     * @var array
     */
    protected $fillable = [
      'name', 'is_root', 'is_dungeon_master'
    ];
}