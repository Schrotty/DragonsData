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
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Party extends Eloquent
{
    protected $collection = 'parties';

    protected $dateFormat = 'd.m.Y';

    protected $dates = ['created_at', 'updated_at'];

    public function createAndNotify()
    {
        $this->save();

        if ($this->member != null) foreach ($this->member as $user) User::find($user)->notify(new PartyEnter($this));
    }

    public function updateAndNotify(Party $old)
    {
        $this->save();

        $gainAccess = array();
        $lostAccess = array();

        if ($old->member == null) $gainAccess = $this->member;
        if ($this->member == null) $lostAccess = $old->member;

        if($this->member != null && $old->member != null) {
            foreach ($this->member as $member) {
                if(!in_array($member, $old->member)) $gainAccess[] = $member;
            }

            foreach ($old->member as $member) {
                if (!in_array($member, $this->member)) $lostAccess[] = $member;
            }
        }

        if ($gainAccess != null) foreach ($gainAccess as $user) $user ??     User::find($user)->notify(new PartyEnter($this));
        if ($lostAccess != null) foreach ($lostAccess as $user) $user ?? User::find($user)->notify(new PartyLeave($this));
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