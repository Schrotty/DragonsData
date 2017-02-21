<?php

namespace App\Http\Controllers;

use App\Models\Sea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('sea.index', ['aObjects' => Sea::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('sea.create', ['sMethod' => 'POST', 'oObject' => new Sea()]);
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
            'ocean' => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()) {
            return Redirect::to('sea/create')->withErrors($oValidator)->withInput();
        }

        $oSea = new Sea();
        $oSea->name = $request->input('name');
        $oSea->description = $request->input('description');
        $oSea->shortDescription = $request->input('short-description');
        $oSea->url = parent::createURL('realm', $oSea->name);
        $oSea->fk_ocean = $request->input('ocean');
        $oSea->save();

        Sea::where('url', $oSea->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('sea.created'));
        return Redirect::to('sea/' . $oSea->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('sea.show', ['oObject' => Sea::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('sea.edit', ['oObject' => Sea::where('url', $sURL)->get()->first()]);
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
            'ocean' => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()) {
            return Redirect::to('sea/edit')->withErrors($oValidator)->withInput();
        }

        $oContinent = Sea::where('url', $sURL)->get()->first();
        $oContinent->name = $request->input('name');
        $oContinent->description = $request->input('description');
        $oContinent->shortDescription = $request->input('short-description');
        $oContinent->fk_ocean = $request->input('ocean');
        $oContinent->knownBy()->sync($aUser);

        $oContinent->save();

        Session::flash('message', trans('sea.updated'));
        return Redirect::to('sea/' . $oContinent->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Sea::where('url', $sURL)->get()->first()->delete();
        return Redirect::to('/');
    }
}
