<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Auth extends Eloquent
{
    protected $collection = 'auth';
}
