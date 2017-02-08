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
use App\Models\Place;
use Illuminate\Support\Facades\Gate;

class PlaceController extends Controller implements IController
{
    /**
     * SmallCityController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iSmallCityID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iPlaceID)
    {
        return view('place', [
            'oPlace' => Place::find($iPlaceID),
            'object' => Place::find($iPlaceID)
        ]);
    }

    /**
     * @param $iPlaceID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iPlaceID)
    {
        $oPlace = Landscape::find($iPlaceID);
        if (Gate::allows('edit-place', $oPlace)) {
            return view('edit.place', [
                'oPlace' => $oPlace,
                'object' => $oPlace
            ]);
        }

        return view('errors.503'); //TODO: create access denied view
    }

    /**
     * @param $iPlaceID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iPlaceID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oPlace = Place::find($iPlaceID);
        $oPlace->description = $_POST['description'];
        $oPlace->shortDescription = $_POST['short-description'];
        $oPlace->fk_landscape = $_POST['landscape'];

        $oPlace->knownBy()->sync($aPostUser);
        $oPlace->save();

        return redirect()->route('small-city', $oPlace);
    }
}