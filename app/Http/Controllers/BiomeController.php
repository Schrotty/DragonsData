<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\Biome;

class BiomeController extends Controller implements IController
{
    /**
     * SmallCityController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iBiomeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iBiomeID)
    {
        return view('biome', [
            'oBiome' => Biome::find($iBiomeID),
            'object' => Biome::find($iBiomeID)
        ]);
    }

    /**
     * @param null $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($iLandscapeID = null)
    {
        return view('create.biome', ['object' => new Biome(), 'iLandscapeID' => $iLandscapeID]);
    }

    /**
     * @param $iBiomeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iBiomeID)
    {
        $oBiome = Biome::find($iBiomeID);
        return view('edit.biome', [
            'oBiome' => $oBiome,
            'object' => $oBiome
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $aTags = array();
        $aPostUser = array();
        if (isset($_POST['tags'])) $aTags = $_POST['tags'];
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Biome::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description']
        ]);

        $oBiome = Biome::all()->last();
        $oBiome->knownBy()->sync($aPostUser);
        $oBiome->tags()->sync($aTags);

        return redirect()->route('biome', $oBiome->id);
    }

    /**
     * @param $iBiomeID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iBiomeID)
    {
        $aPostUser = array();
        $aTags = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];
        if (isset($_POST['tags'])) $aTags = $_POST['tags'];

        $oBiome = Biome::find($iBiomeID);
        $oBiome->description = $_POST['description'];
        $oBiome->shortDescription = $_POST['short-description'];
        $oBiome->fk_landscape = $_POST['landscape'];
        $oBiome->tags()->sync($aTags);

        $oBiome->knownBy()->sync($aPostUser);
        $oBiome->save();

        return redirect()->route('biome', $oBiome->id);
    }
}