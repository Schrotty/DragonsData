<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $collection = 'users';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'username', 'auth', 'password'
    ];

    protected $hidden = [
        'password',
    ];

    use Notifiable {
        notify as protected notifyCall;
    }

    public function authLevel()
    {
        return $this->group;
    }

    public function hasReadAccess(Item $item)
    {
        return $item->userWithReadAccess->contains($this);
    }

    public function hasWriteAccess(Item $item)
    {
        return $item->userWithWriteAccess->contains($this);
    }

    public function known()
    {
        return $this->belongsToMany('App\Item', null, 'known');
    }

    public function parties()
    {
        return $this->belongsToMany('App\Party', 'party_access', 'user_id');
    }

    public function characters()
    {
        return $this->hasOne('App\Item', '_id', 'chars')->get();
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
    }

    /* DEPRECATED */
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

    public function receiveNotifications($types)
    {
        foreach ($types as $type)
        {
            if (!in_array($type, $this->getValue('receiveFrom', array()))) return false;
        }

        return true;
    }

    public function notify($instance)
    {
        if (config('app.notifications')) {
            foreach($this->getValue('receiveFrom', array()) as $notify){
                if ($notify == get_class($instance)) $this->notifyCall($instance);
            }
        }
    }
}