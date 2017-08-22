<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class News extends Eloquent
{
    use Notifiable;

    protected $collection = 'news';

    protected $fillable = [
        'title', 'content', 'author', 'date'
    ];
}
