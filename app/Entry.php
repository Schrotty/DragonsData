<?php

namespace App;

class Entry extends Model
{
    protected $collection = 'entries';
    protected $dateFormat = 'd.m.Y';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'date', 'title', 'content', 'party', 'author'
    ];

    public function journal()
    {
        return $this->belongsTo('App\Party', '_id', 'entries');
    }
}
