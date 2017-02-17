<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Models\Biome;

class BiomeController extends Controller
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

        Biome::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description'],
            'url' => Controller::createURL('App\Models\Biome', $_POST['title'])
        ]);

        $oBiome = Biome::all()->last();
        $oBiome->knownBy()->sync($aPostUser);
        $oBiome->tags()->sync($aTags);

        return redirect()->route('single', [$sModel, $oBiome->url]);
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

        $oBiome = Biome::where('url', $sName)->get()->first();
        $oBiome->name = $_POST['title'];
        $oBiome->description = $_POST['description'];
        $oBiome->shortDescription = $_POST['short-description'];
        $oBiome->fk_landscape = $_POST['landscape'];
        $oBiome->tags()->sync($aTags);

        $oBiome->knownBy()->sync($aPostUser);
        $oBiome->save();

        return redirect()->route('single', [$sModel, $oBiome->url]);
    }
}