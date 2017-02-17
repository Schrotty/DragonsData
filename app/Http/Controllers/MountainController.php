<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Models\Mountain;

class MountainController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Mountain::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\Mountain', $_POST['title'])
        ]);

        $oMountain = Mountain::all()->last();
        $oMountain->knownBy()->sync($aPostUser);

        return redirect()->route('single', [$sModel, $oMountain->url]);
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

        $oMountain = Mountain::where('url', $sName)->get()->first();
        $oMountain->name = $_POST['title'];
        $oMountain->description = $_POST['description'];
        $oMountain->shortDescription = $_POST['short-description'];
        $oMountain->fk_landscape = $_POST['landscape'];

        $oMountain->knownBy()->sync($aPostUser);
        $oMountain->save();

        return redirect()->route('single', [$sModel, $oMountain->url]);
    }
}