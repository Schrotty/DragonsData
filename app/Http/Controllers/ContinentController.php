<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.continent.index', ['aObjects' => Continent::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.continent.create', ['sMethod' => 'POST', 'oObject' => new Continent()]);
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
            'name'              => 'required',
            'description'       => 'required',
            'short-description' => 'required',
            'realm'             => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()){
            return Redirect::to('continent/create')->withErrors($oValidator)->withInput();
        }

        $aParentInfo = explode('-', $request->input('realm'));

        $oContinent = new Continent();
        $oContinent->name = $request->input('name');
        $oContinent->description = $request->input('description');
        $oContinent->shortDescription = $request->input('short-description');
        $oContinent->url = parent::createURL('realm', $oContinent->name);
        $oContinent->fk_realm = $aParentInfo[1];
        $oContinent->save();

        Continent::where('url', $oContinent->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('continent.created'));
        return Redirect::to('continent/' . $oContinent->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.continent.show', ['oObject' => Continent::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.continent.edit', ['oObject' => Continent::where('url', $sURL)->get()->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sURL)
    {
        $aUser = $request->input('known-by') == null ? array() : $request->input('known-by');

        $aRules = array(
            'name'              => 'required',
            'description'       => 'required',
            'short-description' => 'required',
            'realm'             => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()){
            return Redirect::to('continent/edit')->withErrors($oValidator)->withInput();
        }

        $aParentInfo = explode('-', $request->input('realm'));

        $oContinent = Continent::where('url', $sURL)->get()->first();
        $oContinent->name = $request->input('name');
        $oContinent->description = $request->input('description');
        $oContinent->shortDescription = $request->input('short-description');
        $oContinent->fk_realm = $aParentInfo[1];
        $oContinent->knownBy()->sync($aUser);

        $oContinent->save();

        Session::flash('message', trans('continent.updated'));
        return Redirect::to('continent/' . $oContinent->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Continent::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('continent.deleted'));
        return Redirect::to('/');
    }
}
