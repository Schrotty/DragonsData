<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Journal extends Eloquent
{
    protected $collection = 'journal';
    protected $dateFormat = 'd.m.Y';
    protected $dates = ['created_at', 'updated_at'];
}
