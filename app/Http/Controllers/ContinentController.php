<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:34
 */

namespace App\Http\Controllers;

use App\Continent;
use Illuminate\Support\Facades\Gate;

class ContinentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function single($oContinentId)
    {
        return view('continent', [
            'oContinent' => Continent::find($oContinentId),
            'object' => Continent::find($oContinentId)
        ]);
    }

    public function editor($continendID)
    {
        $oContinent = Continent::find($continendID);
        if (Gate::allows('edit-continent', $oContinent)) {
            return view('edit.continent', [
                'oContinent' => $oContinent,
                'object' => $oContinent
            ]);
        }

        return view('errors.503'); //TODO: create access denied view
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
        $oContinent->description = $_POST['description'];
        //$oContinent->fk_realm = $_POST['realm'];
        $oContinent->knownBy()->sync($aPostUser);
        $oContinent->save();

        return redirect()->route('continent', $iContinentID);
    }
}