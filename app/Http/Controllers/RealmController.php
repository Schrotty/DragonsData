<?php

namespace App\Http\Controllers;

use App\Realm;
use Illuminate\Support\Facades\Gate;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Gate::allows('view-realms'))
        {
            return view('realms', ['realms' => Realm::all()]);
        }

        return view('errors.503'); //TODO: create access denied view
    }

    /**
     * @param $realmId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($realmId)
    {
        return view('realm', [
            'realm' => Realm::find($realmId),
            'object' => Realm::find($realmId)
        ]);
    }

    /**
     * @param $realmId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($realmId)
    {
        $oRealm = Realm::find($realmId);
        if (Gate::allows('edit-realm', $oRealm)) {
            return view('edit.realm', [
                'realm' => $oRealm,
                'object' => $oRealm
            ]);
        }

        return view('errors.503'); //TODO: create access denied view
    }

    /**
     * @param $realmID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($realmID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oRealm = Realm::find($realmID);
        $oRealm->description = $_POST['description'];
        $oRealm->fk_gamemaster = $_POST['dungeon-master'];
        $oRealm->knownBy()->sync($aPostUser);
        $oRealm->save();

        return redirect()->route('realm', $realmID);
    }
}