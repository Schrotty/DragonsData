<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use GrahamCampbell\Markdown\Facades\Markdown;

class News extends Model
{
    use Notifiable;

    protected $collection = 'news';

    protected $fillable = [
        'title', 'content', 'author', 'date'
    ];

    public function post()
    {
        return Markdown::convertToHTML($this->getValue('content'));
    }
}
