<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Property extends Eloquent
{
    protected $collection = 'properties';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];
}
