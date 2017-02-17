<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:34
 */

namespace App\Http\Controllers;

use App\Models\Continent;

class ContinentController extends Controller
{
    /**
     * @param $sModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function create($sModel)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Continent::create([
            'name' => $_POST['title'],
            'fk_realm' => $_POST['realm'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\Continent', $_POST['title'])
        ]);

        $oContinent = Continent::all()->last();
        $oContinent->knownBy()->sync($aPostUser);

        return redirect()->route('single', [$sModel, $oContinent->url]);
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

        $oContinent = Continent::where('url', $sName)->get()->first();
        $oContinent->name = $_POST['title'];
        $oContinent->description = $_POST['description'];
        $oContinent->shortDescription = $_POST['short-description'];
        $oContinent->fk_realm = $_POST['realm'];

        $oContinent->knownBy()->sync($aPostUser);
        $oContinent->save();

        return redirect()->route('single', [$sModel, $oContinent->url]);
    }
}