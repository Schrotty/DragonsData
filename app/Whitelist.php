<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Whitelist extends Eloquent
{
    protected $collection = 'whitelist';
}
