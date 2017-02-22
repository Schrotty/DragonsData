<?php

namespace App\Http\Controllers;

use App\Models\Landscape;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class LandscapeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.landscape.index', ['aObjects' => Landscape::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.landscape.create', ['sMethod' => 'POST', 'oObject' => new landscape()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aUser = $request->input('known-by') == null ? array() : $request->input('known-by');

        $aRules = array(
            'name' => 'required',
            'description' => 'required',
            'short-description' => 'required',
            'parent' => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()) {
            return Redirect::to('landscape/create')->withErrors($oValidator)->withInput();
        }

        $aParentInfo = explode('-', $request->input('parent'));
        $sParentCol = 'fk_' . $aParentInfo[0];

        $oLandscape = new Landscape();
        $oLandscape->name = $request->input('name');
        $oLandscape->description = $request->input('description');
        $oLandscape->shortDescription = $request->input('short-description');
        $oLandscape->url = parent::createURL('realm', $oLandscape->name);
        $oLandscape->$sParentCol = $aParentInfo[1];
        $oLandscape->save();

        Landscape::where('url', $oLandscape->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('landscape.created'));
        return Redirect::to('landscape/' . $oLandscape->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.landscape.show', ['oObject' => Landscape::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.landscape.edit', ['oObject' => Landscape::where('url', $sURL)->get()->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sURL)
    {
        $aUser = $request->input('known-by') == null ? array() : $request->input('known-by');

        $aRules = array(
            'name' => 'required',
            'description' => 'required',
            'short-description' => 'required',
            'parent' => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()) {
            return Redirect::to('landscape/edit')->withErrors($oValidator)->withInput();
        }

        $aParentInfo = explode('-', $request->input('parent'));
        $sParentCol = 'fk_' . $aParentInfo[0];

        $oLandscape = Landscape::where('url', $sURL)->get()->first();
        $oLandscape->fk_continent = null;
        $oLandscape->fk_island = null;

        $oLandscape->name = $request->input('name');
        $oLandscape->description = $request->input('description');
        $oLandscape->shortDescription = $request->input('short-description');
        $oLandscape->$sParentCol = $aParentInfo[1];
        $oLandscape->knownBy()->sync($aUser);

        $oLandscape->save();

        Session::flash('message', trans('landscape.updated'));
        return Redirect::to('landscape/' . $oLandscape->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Landscape::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('landscape.deleted'));
        return Redirect::to('/');
    }
}
