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
use Illuminate\Support\Facades\Gate;

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
     * @param $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iLandscapeID)
    {
        $oLandscape = Landscape::find($iLandscapeID);
        if (Gate::allows('edit-landscape', $oLandscape)) {
            return view('edit.landscape', [
                'oLandscape' => $oLandscape,
                'object' => $oLandscape
            ]);
        }

        return view('errors.503'); //TODO: create access denied view
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