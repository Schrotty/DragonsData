<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;

class User extends Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    use Notifiable;

    protected $primaryKey = '_id';

    protected $collection = 'users';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'username', 'group'
    ];

    protected $hidden = [
        'password',
    ];

    public function isRoot()
    {
        return $this->group == Groups::ROOT;
    }

    public function isAdmin()
    {
        return $this->group <= Groups::ADMIN;
    }

    public function isMember()
    {
        return $this->group <= Groups::MEMBER;
    }

    public function known()
    {
        return $this->belongsToMany('App\Item', null, 'known');
    }

    public function author()
    {
        return $this->belongsToMany('App\Item', null, 'author');
    }

    public function contributor()
    {
        return $this->belongsToMany('App\Item', null, 'contributor');
    }

    public function accessible()
    {
        return $this->known()->get()->merge($this->contributor()->get())->merge($this->author()->get());

        //return $this->known()->mergeBindings($this->contributor()->getBaseQuery())->mergeBindings($this->author()->getBaseQuery());
    }
}