<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Models\Landscape;

class LandscapeController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Landscape::create([
            'name' => $_POST['title'],
            'fk_continent' => $_POST['continent'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\landscape', $_POST['title'])
        ]);

        $oLandscape = Landscape::all()->last();
        $oLandscape->knownBy()->sync($aPostUser);

        return redirect()->route('single', [$sModel, $oLandscape->url]);
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

        $oLandscape = Landscape::where('url', $sName)->get()->first();
        $oLandscape->name = $_POST['title'];
        $oLandscape->description = $_POST['description'];
        $oLandscape->shortDescription = $_POST['short-description'];
        $oLandscape->fk_continent = $_POST['continent'];

        $oLandscape->knownBy()->sync($aPostUser);
        $oLandscape->save();

        return redirect()->route('single', [$sModel, $sName]);
    }
}