<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:02
 */

namespace App\Models;

use App\Models\Interfaces\IModel;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed continent
 */
class Landscape extends Model implements IModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'landscape';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function largeCities()
    {
        return $this->hasMany('App\Models\LargeCity', 'fk_landscape', 'id')->get();
    }

    /**
     * @return array
     */
    public function mediumCities()
    {
        return array();
    }

    /**
     * @return array
     */
    public function smallCities()
    {
        return array();
    }

    /**
     * @return mixed
     */
    public function places()
    {
        return array();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function continent()
    {
        return $this->hasOne('App\Models\Continent', 'id', 'fk_continent');
    }

    /**
     * @param $user
     * @return User|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function knownByUser($user)
    {
        $oUser = $this->knownBy()->find($user->id);
        if ($oUser == null) {
            return new User();
        }

        return $oUser;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function knownBy()
    {
        return $this->belongsToMany('App\Models\User', 'knownLandscape', 'fk_landscape', 'fk_user');
    }

    /**
     * @return mixed
     */
    public function formatDescription()
    {
        return Markdown::convertToHtml($this->description);
    }
}