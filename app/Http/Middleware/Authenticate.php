<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 08.10.2017
 * Time: 14:20
 */

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Auth;

class Authenticate extends Auth
{
    public function handle()
    {
        //check here if the user is authenticated
        if(!$this->auth->user()) redo

        return $next($request);
    }
}