<?php

namespace App;

class Property extends Model
{
    protected $collection = 'properties';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];
}
