<?php

namespace App\Http\Controllers\Util;

use Illuminate\Support\Facades\Route;

class RouteHelper
{
    public static function isRoute(string $name)
    {
        return $name == explode('/', Route::getFacadeRoot()->current()->uri)[0];
    }
}
