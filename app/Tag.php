<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Tag extends Model
{
    protected $collection = 'tags';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];
}
