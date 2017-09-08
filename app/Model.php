<?php

namespace App;

use Jenssegers\Mongodb\Collection;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    public function getValCount(string $key)
    {
        return count($this->attributes[$key] ?? array());
    }

    public function hasValues(string $key)
    {
        return $this->getValCount($key) > 0;
    }

    public function getValue(string $key, $default = null)
    {
        return $this->attributes[$key] ?? $default ?? 'None';
    }

    public static function exist($id)
    {
        return get_called_class()::find($id) == null ? false : true;
    }

    public static function byId($id)
    {
        return get_called_class()::find($id) ?? new Model();
    }
}