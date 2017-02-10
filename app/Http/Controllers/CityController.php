<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\City;

class CityController extends Controller implements IController
{
    /**
     * SmallCityController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iCityID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iCityID)
    {
        return view('city', [
            'oCity' => City::find($iCityID),
            'object' => City::find($iCityID)
        ]);
    }

    /**
     * @param null $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($iLandscapeID = null)
    {
        return view('create.city', ['object' => new City(), 'iLandscapeID' => $iLandscapeID]);
    }

    /**
     * @param $iCityID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iCityID)
    {
        $oCity = City::find($iCityID);
        return view('edit.city', [
            'oCity' => $oCity,
            'object' => $oCity
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

        City::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description']
        ]);

        $oCity = City::all()->last();
        $oCity->knownBy()->sync($aPostUser);
        $oCity->tags()->sync($aTags);

        return redirect()->route('city', $oCity->id);
    }

    /**
     * @param $iCityID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iCityID)
    {
        $aPostUser = array();
        $aTags = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['tags'])) $aTags = $_POST['tags'];

        $oCity = City::find($iCityID);
        $oCity->description = $_POST['description'];
        $oCity->shortDescription = $_POST['short-description'];
        $oCity->fk_landscape = $_POST['landscape'];
        $oCity->tags()->sync($aTags);

        $oCity->knownBy()->sync($aPostUser);
        $oCity->save();

        return redirect()->route('city', $oCity);
    }
}