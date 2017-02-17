<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Models\River;

class RiverController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        River::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\River', $_POST['title'])
        ]);

        $oRiver = River::all()->last();
        $oRiver->knownBy()->sync($aPostUser);

        return redirect()->route('single', [$sModel, $oRiver->url]);
    }

    /**
     * @param $sModel
     * @param $sName
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function save($sModel, $sName)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oLandscape = River::where('url', $sName)->get()->first();
        $oLandscape->name = $_POST['title'];
        $oLandscape->description = $_POST['description'];
        $oLandscape->shortDescription = $_POST['short-description'];
        $oLandscape->fk_landscape = $_POST['landscape'];

        $oLandscape->knownBy()->sync($aPostUser);
        $oLandscape->save();

        return redirect()->route('single', [$sModel, $oLandscape->url]);
    }
}