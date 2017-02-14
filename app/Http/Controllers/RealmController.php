<?php

namespace App\Http\Controllers;

use App\Models\Realm;
use Illuminate\Support\Facades\Auth;

class RealmController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $realmId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($realmId)
    {
        $oRealm = Realm::find($realmId);
        return view('realm', [
            'realm' => $oRealm, 'object' => $oRealm
        ]);
    }

    /**
     * @param bool $bOpen
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($bOpen = null)
    {
        return view('create.realm', ['object' => new Realm(), 'open' => $bOpen]);
    }

    /**
     * @param $realmId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($realmId)
    {
        $oRealm = Realm::find($realmId);
        return view('edit.realm', [
            'realm' => $oRealm, 'object' => $oRealm
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $bOpen = false;
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['is-open'])) $bOpen = $_POST['is-open'];

        Realm::create([
            'name' => $_POST['title'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'fk_creator' => Auth::user()->id,
            'fk_gamemaster' => $_POST['dungeon-master'],
            'isOpen' => $bOpen == true ? 1 : 0
        ]);

        $oRealm = Realm::all()->last();
        $oRealm->knownBy()->sync($aPostUser);

        return redirect()->route('realm', $oRealm->id);
    }

    /**
     * @param $realmID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($realmID)
    {
        $bOpen = false;
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['is-open'])) $bOpen = $_POST['is-open'];

        $oRealm = Realm::find($realmID);
        $oRealm->name = $_POST['title'];
        $oRealm->description = $_POST['description'];
        $oRealm->shortDescription = $_POST['short-description'];
        $oRealm->fk_dungeonMaster = $_POST['dungeon-master'];
        $oRealm->isOpen = $bOpen == true ? 1 : 0;

        $oRealm->knownBy()->sync($aPostUser);
        $oRealm->save();

        return redirect()->route('realm', $realmID);
    }
}