<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Item extends Eloquent
{
    protected $collection = 'item';

    protected $fillable = [
        'name'
    ];

    public function hasReadPrivileges(User $user)
    {
        return $this->isAuthor($user) || $this->isContributor($user) || $this->knownBy($user);
    }

    public function hasWritePrivileges(User $user)
    {
        return $this->isAuthor($user) || $this->isContributor($user);
    }

    public function hasDeletePrivileges(User $user)
    {
        return $this->isAuthor($user);
    }

    public function knownBy(User $user)
    {
        if($this->known != null) {
            return in_array($user->_id, $this->known);
        }

        return false;
    }

    public function isContributor(User $user)
    {
        if($this->contributors != null) {
            return in_array($user->_id, $this->contributors);
        }

        return false;
    }

    public function isAuthor(User $user)
    {
        return $user->_id == $this->author;
    }
}
