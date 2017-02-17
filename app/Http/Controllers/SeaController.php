<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:34
 */

namespace App\Http\Controllers;

use App\Models\Sea;

class SeaController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Sea::create([
            'name' => $_POST['title'],
            'fk_ocean' => $_POST['ocean'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\Ocean', $_POST['title'])
        ]);

        $oSea = Sea::all()->last();
        $oSea->knownBy()->sync($aPostUser);

        return redirect()->route('single', [$sModel, $oSea->url]);
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

        $oSea = Sea::where('url', $sName)->get()->first();
        $oSea->name = $_POST['title'];
        $oSea->description = $_POST['description'];
        $oSea->shortDescription = $_POST['short-description'];
        $oSea->fk_ocean = $_POST['ocean'];

        $oSea->knownBy()->sync($aPostUser);
        $oSea->save();

        return redirect()->route('single', [$sModel, $oSea->url]);
    }
}