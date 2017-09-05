<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Settings extends Eloquent
{
    protected $collection = 'settings';

    public static function playerTag()
    {
        return Settings::where('type', '=', 'system')->first()->pctag;
    }

    public static function maintenanceWhitelist()
    {
        return Whitelist::all();
    }

    public static function isWhitelisted($clientIp)
    {
        return self::maintenanceWhitelist()->contains('ip', $clientIp);
    }
}
