<?php

namespace App;

class Tag extends Model
{
    protected $collection = 'tags';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
