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

    public function hasEntries()
    {
        return count($this->entries) >= 1;
    }

    /**
     * @param Item $character
     * @return mixed
     */
    public static function partiesWhereMember(Item $character)
    {
        return Party::whereRaw(array('$text'=>array('$search'=> "\"" . $character->_id . "\"")))->get();
    }
}