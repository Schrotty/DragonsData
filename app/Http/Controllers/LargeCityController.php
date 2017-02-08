<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\LargeCity;
use Illuminate\Support\Facades\Gate;

/**
 * Class LargeCityController
 * @package App\Http\Controllers
 */
class LargeCityController extends Controller implements IController
{
    /**
     * LargeCityController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iLargeCityID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iLargeCityID)
    {
        return view('largeCity', [
            'oLargeCity' => LargeCity::find($iLargeCityID),
            'object' => LargeCity::find($iLargeCityID)
        ]);
    }

    /**
     * @param $iLargeCityID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iLargeCityID)
    {
        $oLargeCity = LargeCity::find($iLargeCityID);
        if (Gate::allows('edit-large-city', $oLargeCity)) {
            return view('edit.largeCity', [
                'oLargeCity' => $oLargeCity,
                'object' => $oLargeCity
            ]);
        }

        return view('errors.503'); //TODO: create access denied view
    }

    /**
     * @param $iLargeCityID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iLargeCityID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oLandscape = LargeCity::find($iLargeCityID);
        $oLandscape->description = $_POST['description'];
        $oLandscape->shortDescription = $_POST['short-description'];
        $oLandscape->fk_landscape = $_POST['landscape'];

        $oLandscape->knownBy()->sync($aPostUser);
        $oLandscape->save();

        return redirect()->route('landscape', $iLargeCityID);
    }
}