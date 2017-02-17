<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:34
 */

namespace App\Http\Controllers;

use App\Models\Ocean;

class OceanController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Ocean::create([
            'name' => $_POST['title'],
            'fk_realm' => $_POST['realm'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\Ocean', $_POST['title'])
        ]);

        $oOcean = Ocean::all()->last();
        $oOcean->knownBy()->sync($aPostUser);

        return redirect()->route('single', [$sModel, $oOcean->url]);
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

        $oOcean = Ocean::where('url', $sName)->get()->first();
        $oOcean->name = $_POST['title'];
        $oOcean->description = $_POST['description'];
        $oOcean->shortDescription = $_POST['short-description'];
        $oOcean->fk_realm = $_POST['realm'];

        $oOcean->knownBy()->sync($aPostUser);
        $oOcean->save();

        return redirect()->route('single', [$sModel, $oOcean->url]);
    }
}