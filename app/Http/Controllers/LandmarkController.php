<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\Landmark;

class LandmarkController extends Controller implements IController
{
    /**
     * SmallCityController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iLandmarkID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iLandmarkID)
    {
        return view('landmark', [
            'oLandmark' => Landmark::find($iLandmarkID),
            'object' => Landmark::find($iLandmarkID)
        ]);
    }

    /**
     * @param null $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($iLandscapeID = null)
    {
        return view('create.landmark', ['object' => new Landmark(), 'iLandscapeID' => $iLandscapeID]);
    }

    /**
     * @param $iLandmarkID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iLandmarkID)
    {
        $oLandmark = Landmark::find($iLandmarkID);
        return view('edit.landmark', [
            'oLandmark' => $oLandmark,
            'object' => $oLandmark
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $aTags = array();
        $aPostUser = array();
        if (isset($_POST['tags'])) $aTags = $_POST['tags'];
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Landmark::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description']
        ]);

        $oLandmark = Landmark::all()->last();
        $oLandmark->knownBy()->sync($aPostUser);
        $oLandmark->tags()->sync($aTags);

        return redirect()->route('landmark', $oLandmark->id);
    }

    /**
     * @param $iLandmarkID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iLandmarkID)
    {
        $aPostUser = array();
        $aTags = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['tags'])) $aTags = $_POST['tags'];

        $oLandmark = Landmark::find($iLandmarkID);
        $oLandmark->name = $_POST['title'];
        $oLandmark->description = $_POST['description'];
        $oLandmark->shortDescription = $_POST['short-description'];
        $oLandmark->fk_landscape = $_POST['landscape'];

        $oLandmark->knownBy()->sync($aPostUser);
        $oLandmark->tags()->sync($aTags);
        $oLandmark->save();

        return redirect()->route('landmark', $oLandmark->id);
    }
}