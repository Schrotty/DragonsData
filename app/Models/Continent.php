<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 16:00
 */

namespace App\Models;

use App\Models\Interfaces\IModel;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed realm
 */
class Continent extends Model implements IModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'continent';

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
    public function landscapes()
    {
        return $this->hasMany('App\Models\Landscape', 'fk_continent', 'id')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function realm()
    {
        return $this->hasOne('App\Models\Realm', 'id', 'fk_realm');
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
        return $this->belongsToMany('App\Models\User', 'knownContinent', 'fk_continent', 'fk_user');
    }

    /**
     * @return mixed
     */
    public function formatDescription()
    {
        return Markdown::convertToHtml($this->description); // <p>foo</p>
    }
}