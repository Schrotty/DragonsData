<?php

namespace App;

class Item extends Model
{
    protected $collection = 'item';

    protected $fillable = [
        'name', 'author', 'known', 'contributors', 'category', 'description'
    ];

    public function category()
    {
        return Category::find($this->getValue('category'));
    }

    public function hasReadPrivileges(User $user)
    {
        return $this->isAuthor($user) || $this->isContributor($user) || $this->knownBy($user) || $user->isAdmin();
    }

    public function hasWritePrivileges(User $user)
    {
        return $this->isAuthor($user) || $this->isContributor($user) || $user->isAdmin();
    }

    public function hasDeletePrivileges(User $user)
    {
        return $this->isAuthor($user) || $user->isAdmin();
    }

    public function knownBy(User $user)
    {
        if($this->known != null) {
            return in_array($user->_id, $this->known);
        }

        return false;
    }

    public function isContributor(User $user)
    {
        if($this->contributors != null) {
            return in_array($user->_id, $this->contributors);
        }

        return false;
    }

    public function isAuthor(User $user)
    {
        return $user->_id == $this->author;
    }

    public static function byTag($id)
    {
        $tag = Tag::all()->where('_id', '=', $id)->first();
        if ($tag == null) return array();

        return Item::all()->where('tags', 'all', [$tag->_id]);
    }

    public static function getPlayer($value)
    {
        return Item::all()->where('category', '=', $value);
    }

    /**
     * @param $id
     * @return array|static
     */
    public static function byParty($id)
    {
        return Item::all()->where('party', 'all', $id) ?? array();
    }
}