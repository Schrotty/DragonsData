<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Models\Lake;

class LakeController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Lake::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\Lake', $_POST['title'])
        ]);

        $oLake = Lake::all()->last();
        $oLake->knownBy()->sync($aPostUser);

        return redirect()->route('single', [$sModel, $oLake->url]);
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

        $oLake = Lake::where('url', $sName)->get()->first();
        $oLake->name = $_POST['title'];
        $oLake->description = $_POST['description'];
        $oLake->shortDescription = $_POST['short-description'];
        $oLake->fk_landscape = $_POST['landscape'];

        $oLake->knownBy()->sync($aPostUser);
        $oLake->save();

        return redirect()->route('single', [$sModel, $oLake->url]);
    }
}