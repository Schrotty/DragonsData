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

    public function party()
    {
        return $this->hasOne('App\Party', 'id', 'party_id');
    }

    public function getTeaser()
    {
        return substr($this->getValue('content'), 0, 50);
    }
}
