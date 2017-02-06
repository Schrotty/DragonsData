<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 16:52
 */

namespace App\Models;

use App\Models\Interfaces\IModel;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class LargeCity extends Model implements IModel
{
    protected $table = "largeCity";

    public function landscape()
    {
        return $this->hasOne('App\Models\Landscape', 'fk_landscape', 'id')->get();
    }

    public function knownByUser($user)
    {
        $oUser = $this->knownBy()->find($user->id);
        if ($oUser == null) {
            return new User();
        }

        return $oUser;
    }

    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownLargeCity', 'fk_largeCity', 'fk_user')->get();
    }

    public function formatDescription()
    {
        return Markdown::convertToHtml($this->formatDescription());
    }
}