<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.08.2017
 * Time: 17:36
 */

namespace App;

use App\Notifications\PartyEnter;
use App\Notifications\PartyLeave;

class Party extends Model
{
    protected $collection = 'parties';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];

    public function items()
    {
        return $this->belongsToMany('App\Item', 'item_parties', 'party_id', 'item_id');
    }

    public function entries()
    {
        return $this->hasMany('App\Entry', 'party_id');
    }

    public function member()
    {
        return $this->belongsToMany('App\User', 'party_access', 'party_id', 'user_id');
    }

    public function chronist()
    {
        return $this->hasOne('App\User', 'id', 'chronist_id');
    }

    public function characters()
    {
        return $this->belongsToMany('App\Item', 'party_characters', 'party_id', 'item_id');
    }

    public function hasEntries()
    {
        return count($this->entries) >= 1;
    }

    public function hasMember()
    {
        return count($this->member) >= 1;
    }

    public function hasChronist()
    {
        return $this->chronist != null;
    }

    public function hasCharacters()
    {
        return count($this->characters) >= 1;
    }
}