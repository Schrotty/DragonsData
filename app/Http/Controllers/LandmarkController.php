<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Models\Landmark;

class LandmarkController extends Controller
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

        Landmark::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\Landmark', $_POST['title'])
        ]);

        $oLandmark = Landmark::all()->last();
        $oLandmark->knownBy()->sync($aPostUser);
        $oLandmark->tags()->sync($aTags);

        return redirect()->route('single', [$sModel, $oLandmark->url]);
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

        $oLandmark = Landmark::where('url', $sName)->get()->first();
        $oLandmark->name = $_POST['title'];
        $oLandmark->description = $_POST['description'];
        $oLandmark->shortDescription = $_POST['short-description'];
        $oLandmark->fk_landscape = $_POST['landscape'];

        $oLandmark->knownBy()->sync($aPostUser);
        $oLandmark->tags()->sync($aTags);
        $oLandmark->save();

        return redirect()->route('single', [$sModel, $oLandmark->url]);
    }
}