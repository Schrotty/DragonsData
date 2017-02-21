<?php

namespace App\Models\Base;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed description
 * @property mixed knownBy
 */
abstract class BaseModel extends Model
{

    /**
     * @return string
     */
    public function getModel()
    {
        return strtolower(substr(get_class($this), 11));
    }

    /**
     * Does a specific user know this object?
     *
     * @param $oUser
     * @return bool
     */
    public function knownByUser($oUser)
    {
        return $this->knownBy->find($oUser->id) != null;
    }

    /**
     * Formats the markdown description of an object.
     *
     * @return mixed
     */
    public function formatDescription()
    {
        return Markdown::convertToHtml($this->description);
    }

    /**
     * Is object unknown?
     *
     * @return bool
     */
    public function isUnknown()
    {
        return count($this->knownBy) == 0 ? true : false;
    }
}