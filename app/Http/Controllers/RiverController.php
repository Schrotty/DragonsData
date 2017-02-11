<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\River;

class RiverController extends Controller implements IController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iRiverID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iRiverID)
    {
        return view('river', [
            'oRiver' => River::find($iRiverID),
            'object' => River::find($iRiverID)
        ]);
    }

    /**
     * @param null $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($iLandscapeID = null)
    {
        return view('create.river', ['object' => new River(), 'iLandscapeID' => $iLandscapeID]);
    }

    /**
     * @param $iRiverID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iRiverID)
    {
        $oRiver = River::find($iRiverID);
        return view('edit.river', [
            'oRiver' => $oRiver,
            'object' => $oRiver
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        River::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description']
        ]);

        $oRiver = River::all()->last();
        $oRiver->knownBy()->sync($aPostUser);

        return redirect()->route('river', $oRiver->id);
    }

    /**
     * @param $iRiverID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iRiverID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oLandscape = River::find($iRiverID);
        $oLandscape->name = $_POST['title'];
        $oLandscape->description = $_POST['description'];
        $oLandscape->shortDescription = $_POST['short-description'];
        $oLandscape->fk_landscape = $_POST['landscape'];

        $oLandscape->knownBy()->sync($aPostUser);
        $oLandscape->save();

        return redirect()->route('river', $iRiverID);
    }
}