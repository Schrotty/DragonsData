<?php

namespace App;

class Journal extends Model
{
    protected $collection = 'journal';
    protected $dateFormat = 'd.m.Y';
    protected $dates = ['created_at', 'updated_at'];
}
