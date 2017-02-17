<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Models\City;

class CityController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aTags = array();
        $aPostUser = array();
        if (isset($_POST['tags'])) $aTags = $_POST['tags'];
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        City::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\City', $_POST['title'])
        ]);

        $oCity = City::all()->last();
        $oCity->knownBy()->sync($aPostUser);
        $oCity->tags()->sync($aTags);

        return redirect()->route('single', [$sModel, $oCity->url]);
    }

    /**
     * @param $sModel
     * @param $sName
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function save($sModel, $sName)
    {
        $aPostUser = array();
        $aTags = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['tags'])) $aTags = $_POST['tags'];

        $oCity = City::where('url', $sName)->get()->first();
        $oCity->description = $_POST['description'];
        $oCity->shortDescription = $_POST['short-description'];
        $oCity->fk_landscape = $_POST['landscape'];
        $oCity->tags()->sync($aTags);

        $oCity->knownBy()->sync($aPostUser);
        $oCity->save();

        return redirect()->route('single', [$sModel, $oCity->url]);
    }
}