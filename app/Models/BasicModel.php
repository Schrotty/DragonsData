<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 15.02.2017
 * Time: 15:09
 */

namespace App\Models;


use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class BasicModel extends Model
{
    use ElasticquentTrait;

    /**
     * @var string
     */
    protected $table = 'model';
}