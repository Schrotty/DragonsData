<?php

namespace App;

class Settings extends Model
{
    protected $collection = 'settings';

    public static function getSetings()
    {
        return Settings::where('type', '=', 'system')->first();
    }

    public static function playerIdent()
    {
        return Settings::getSetings()->playerIdentifier;
    }

    public static function maintenanceWhitelist()
    {
        return Whitelist::all();
    }

    public static function isWhitelisted($clientIp)
    {
        return self::maintenanceWhitelist()->contains('ip', $clientIp);
    }

    public static function maintainMessage()
    {
        return Settings::where('type', '=', 'system')->first()->mmessage ??
            'We are performing scheduled maintenance. We should be back online shortly.';
    }
}
