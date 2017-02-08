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
use App\Models\MediumCity;
use Illuminate\Support\Facades\Gate;

class MediumCityController extends Controller implements IController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iMediumCityID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iMediumCityID)
    {
        return view('mediumCity', [
            'oMediumCity' => MediumCity::find($iMediumCityID),
            'object' => MediumCity::find($iMediumCityID)
        ]);
    }

    /**
     * @param $iMediumCityID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iMediumCityID)
    {
        $oMediumCity = Landscape::find($iMediumCityID);
        if (Gate::allows('edit-medium-city', $oMediumCity)) {
            return view('edit.landscape', [
                'oLandscape' => $oMediumCity,
                'object' => $oMediumCity
            ]);
        }

        return view('errors.503'); //TODO: create access denied view
    }

    /**
     * @param $iMediumCityID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iMediumCityID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oMediumCity = MediumCity::find($iMediumCityID);
        $oMediumCity->description = $_POST['description'];
        $oMediumCity->shortDescription = $_POST['short-description'];
        $oMediumCity->fk_landscape = $_POST['landscape'];

        $oMediumCity->knownBy()->sync($aPostUser);
        $oMediumCity->save();

        return redirect()->route('medium-city', $iMediumCityID);
    }
}