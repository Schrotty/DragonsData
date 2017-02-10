<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\Landscape;

class LandscapeController extends Controller implements IController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iLandscapeID)
    {
        return view('landscape', [
            'oLandscape' => Landscape::find($iLandscapeID),
            'object' => Landscape::find($iLandscapeID)
        ]);
    }

    /**
     * @param null $iContinentID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($iContinentID = null)
    {
        return view('create.landscape', ['object' => new Landscape(), 'iContinentID' => $iContinentID]);
    }

    /**
     * @param $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iLandscapeID)
    {
        $oLandscape = Landscape::find($iLandscapeID);
        return view('edit.landscape', [
            'oLandscape' => $oLandscape,
            'object' => $oLandscape
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Landscape::create([
            'name' => $_POST['title'],
            'fk_continent' => $_POST['continent'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description']
        ]);

        $oLandscape = Landscape::all()->last();
        $oLandscape->knownBy()->sync($aPostUser);

        return redirect()->route('landscape', $oLandscape->id);
    }

    /**
     * @param $iLandscapeID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iLandscapeID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oLandscape = Landscape::find($iLandscapeID);
        $oLandscape->name = $_POST['title'];
        $oLandscape->description = $_POST['description'];
        $oLandscape->shortDescription = $_POST['short-description'];
        $oLandscape->fk_continent = $_POST['continent'];
        $oLandscape->knownBy()->sync($aPostUser);
        $oLandscape->save();

        return redirect()->route('landscape', $iLandscapeID);
    }
}