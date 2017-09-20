<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use GrahamCampbell\Markdown\Facades\Markdown;

class Model extends Eloquent
{
    public function getModelName()
    {
        return strtolower(substr(get_class($this), 4));
    }

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
        $value = $this->attributes[$key] ?? null;
        if ($value == null || $value == "") return $default ?? 'None';

        return $this->attributes[$key];
    }

    public function toMarkdown(string $key, $default = null)
    {
        $markdown = Markdown::convertToHTML($this->getValue($key, $default));
        if ($markdown == "") return $this->getValue($key, $default);
        return $markdown;
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