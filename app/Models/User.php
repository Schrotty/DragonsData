<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property mixed id
 * @property mixed isRootAdmin
 * @property mixed realms
 * @property mixed isAdmin
 * @property mixed isDungeonMaster
 * @property mixed isGameMaster
 * @property mixed name
 * @property mixed rank
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'url', 'email', 'fk_rank'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return string
     */
    public function getModel()
    {
        return strtolower(substr(get_class($this), 11));
    }

    /**
     * @return bool
     */
    public function hasRealms()
    {
        return count($this->realms) >= 1 ? true : false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rank()
    {
        return $this->hasOne('App\Models\Rank', 'id', 'fk_rank')->get()->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function knownRealms()
    {
        if ($this->rank()->is_root) {
            return Realm::all();
        }

        return $this->masterRealms()->merge($this->assignedRealms());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function masterRealms()
    {
        return $this->hasMany('App\Models\Realm', 'fk_dungeonMaster', 'id')->getEager();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function assignedRealms()
    {
        return $this->belongsToMany('App\Models\Realm', 'knownRealm', 'fk_user', 'fk_realm')->get();
    }

    /**
     * @param string $sName
     * @return mixed
     */
    public static function userWithRank(string $sName)
    {
        $oRank = Rank::where('name', $sName)->get()->first();
        return User::where('fk_rank', $oRank->id);
    }

    /**
     * @param string $sPrivilege
     * @return mixed
     */
    public static function userWithPrivilege(string $sPrivilege)
    {
        $aRankIDs = array();
        $aRanks = Rank::where($sPrivilege, '1')->get();

        foreach ($aRanks as $oRank) {
            $aRankIDs[] = $oRank->id;
        }

        return User::whereIn('fk_rank', $aRankIDs)->get();
    }
}