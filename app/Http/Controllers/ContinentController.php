<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:34
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\Continent;

class ContinentController extends Controller implements IController
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
     * @param $oContinentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($oContinentId)
    {
        return view('continent', [
            'oContinent' => Continent::find($oContinentId),
            'object' => Continent::find($oContinentId)
        ]);
    }

    /**
     * @param null $iRealmID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($iRealmID = null)
    {
        return view('create.continent', ['object' => new Continent(), 'iRealmID' => $iRealmID]);
    }

    /**
     * @param $continendID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($continendID)
    {
        $oContinent = Continent::find($continendID);
        return view('edit.continent', [
            'oContinent' => $oContinent,
            'object' => $oContinent
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Continent::create([
            'name' => $_POST['title'],
            'fk_realm' => $_POST['realm'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description']
        ]);

        $oContinent = Continent::all()->last();
        $oContinent->knownBy()->sync($aPostUser);

        return redirect()->route('continent', $oContinent->id);
    }

    /**
     * @param $iContinentID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iContinentID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oContinent = Continent::find($iContinentID);
        $oContinent->name = $_POST['title'];
        $oContinent->description = $_POST['description'];
        $oContinent->shortDescription = $_POST['short-description'];
        $oContinent->fk_realm = $_POST['realm'];
        $oContinent->knownBy()->sync($aPostUser);
        $oContinent->save();

        return redirect()->route('continent', $oContinent->id);
    }
}