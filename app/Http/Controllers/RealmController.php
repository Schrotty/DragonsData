<?php

namespace App\Http\Controllers;

use App\Models\Realm;
use Illuminate\Support\Facades\Auth;

class RealmController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $bOpen = false;
        $aPostUser = array();

        $aParent = explode('-', $_POST['parent']);
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['is-open'])) $bOpen = $_POST['is-open'];

        Realm::create([
            'name' => $_POST['title'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'fk_creator' => Auth::user()->id,
            'fk_dungeonMaster' => $aParent[1],
            'isOpen' => $bOpen == true ? 1 : 0,
            'url' => Controller::createURL('App\Models\Realm', $_POST['title'])
        ]);

        $oRealm = Realm::all()->last();
        $oRealm->knownBy()->sync($aPostUser);

        return redirect()->route('single', [$sModel, $oRealm->url]);
    }

    /**
     * @param $sModel
     * @param $sName
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function save($sModel, $sName)
    {
        $bOpen = false;
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['is-open'])) $bOpen = $_POST['is-open'];

        $oRealm = Realm::where('url', $sName)->get()->first();
        $oRealm->name = $_POST['title'];
        $oRealm->description = $_POST['description'];
        $oRealm->shortDescription = $_POST['short-description'];
        $oRealm->fk_dungeonMaster = $_POST['parent'];
        $oRealm->isOpen = $bOpen == true ? 1 : 0;

        $oRealm->knownBy()->sync($aPostUser);
        $oRealm->save();

        return redirect()->route('single', [$sModel, $oRealm->url]);
    }
}