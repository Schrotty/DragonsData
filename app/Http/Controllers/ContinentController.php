<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 29.01.2017
 * Time: 17:34
 */

namespace App\Http\Controllers;

use App\Continent;

class ContinentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function single($oContinentId)
    {
        return view('continent', [
            'oContinent' => Continent::find($oContinentId),
            'object' => Continent::find($oContinentId)
        ]);
    }
}