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
use App\Models\SmallCity;
use Illuminate\Support\Facades\Gate;

class SmallCityController extends Controller implements IController
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
    public function single($iSmallCityID)
    {
        return view('smallCity', [
            'oSmallCity' => SmallCity::find($iSmallCityID),
            'object' => SmallCity::find($iSmallCityID)
        ]);
    }

    /**
     * @param $iSmallCityID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iSmallCityID)
    {
        $oSmallCity = Landscape::find($iSmallCityID);
        if (Gate::allows('edit-small-city', $oSmallCity)) {
            return view('edit.landscape', [
                'oSmallCity' => $oSmallCity,
                'object' => $oSmallCity
            ]);
        }

        return view('errors.503'); //TODO: create access denied view
    }

    /**
     * @param $iSmallCityID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iSmallCityID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oMediumCity = SmallCity::find($iSmallCityID);
        $oMediumCity->description = $_POST['description'];
        $oMediumCity->shortDescription = $_POST['short-description'];
        $oMediumCity->fk_landscape = $_POST['landscape'];

        $oMediumCity->knownBy()->sync($aPostUser);
        $oMediumCity->save();

        return redirect()->route('small-city', $oMediumCity);
    }
}