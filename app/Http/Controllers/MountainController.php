<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 06.02.2017
 * Time: 14:05
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IController;
use App\Models\Mountain;

class MountainController extends Controller implements IController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $iMountainID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($iMountainID)
    {
        return view('mountain', [
            'oMountain' => Mountain::find($iMountainID),
            'object' => Mountain::find($iMountainID)
        ]);
    }

    /**
     * @param null $iLandscapeID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creator($iLandscapeID = null)
    {
        return view('create.mountain', ['object' => new Mountain(), 'iLandscapeID' => $iLandscapeID]);
    }

    /**
     * @param $iMountainID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editor($iMountainID)
    {
        $oMountain = Mountain::find($iMountainID);
        return view('edit.mountain', [
            'oMountain' => $oMountain,
            'object' => $oMountain
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        Mountain::create([
            'name' => $_POST['title'],
            'fk_landscape' => $_POST['landscape'],
            'shortDescription' => $_POST['short-description'],
            'description' => $_POST['description']
        ]);

        $oMountain = Mountain::all()->last();
        $oMountain->knownBy()->sync($aPostUser);

        return redirect()->route('mountain', $oMountain->id);
    }

    /**
     * @param $iMountainID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save($iMountainID)
    {
        $aPostUser = array();
        if (isset($_POST['known-by'])) $aPostUser = $_POST['known-by'];

        $oMountain = Mountain::find($iMountainID);
        $oMountain->name = $_POST['title'];
        $oMountain->description = $_POST['description'];
        $oMountain->shortDescription = $_POST['short-description'];
        $oMountain->fk_landscape = $_POST['landscape'];

        $oMountain->knownBy()->sync($aPostUser);
        $oMountain->save();

        return redirect()->route('mountain', $oMountain->id);
    }
}