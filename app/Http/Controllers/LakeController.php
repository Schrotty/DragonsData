<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\Lake;

class LakeController extends Controller implements IController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iLakeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iLakeID)
    {
        return view('lake', [
            'oLake' => Lake::find($iLakeID),
            'object' => Lake::find($iLakeID)
        ]);
    }

    /**
     * @param null $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($iLandscapeID = null)
    {
        return view('create.lake', ['object' => new Lake(), 'iLandscapeID' => $iLandscapeID]);
    }

    /**
     * @param $iLakeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iLakeID)
    {
        $oLake = Lake::find($iLakeID);
        return view('edit.lake', [
            'oLake' => $oLake,
            'object' => $oLake
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Lake::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description']
        ]);

        $oLake = Lake::all()->last();
        $oLake->knownBy()->sync($aPostUser);

        return redirect()->route('lake', $oLake->id);
    }

    /**
     * @param $iLakeID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iLakeID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oLake = Lake::find($iLakeID);
        $oLake->name = $_POST['title'];
        $oLake->description = $_POST['description'];
        $oLake->shortDescription = $_POST['short-description'];
        $oLake->fk_landscape = $_POST['landscape'];

        $oLake->knownBy()->sync($aPostUser);
        $oLake->save();

        return redirect()->route('lake', $iLakeID);
    }
}