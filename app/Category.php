<?php

namespace App;

class Category extends Model
{
    protected $collection = 'categories';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];
}
