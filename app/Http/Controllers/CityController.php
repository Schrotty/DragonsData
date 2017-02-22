<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.city.index', ['aObjects' => City::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.city.create', ['sMethod' => 'POST', 'oObject' => new City()]);
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
            'landscape' => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()) {
            return Redirect::to('city/create')->withErrors($oValidator)->withInput();
        }

        $aParentInfo = explode('-', $request->input('landscape'));

        $oCity = new City();
        $oCity->name = $request->input('name');
        $oCity->description = $request->input('description');
        $oCity->shortDescription = $request->input('short-description');
        $oCity->url = parent::createURL('realm', $oCity->name);
        $oCity->fk_landscape = $aParentInfo[1];
        $oCity->save();

        City::where('url', $oCity->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('city.created'));
        return Redirect::to('city/' . $oCity->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.city.show', ['oObject' => City::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.city.edit', ['oObject' => City::where('url', $sURL)->get()->first()]);
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
            'landscape' => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()) {
            return Redirect::to('city/edit')->withErrors($oValidator)->withInput();
        }

        $aParentInfo = explode('-', $request->input('landscape'));

        $oCity = City::where('url', $sURL)->get()->first();
        $oCity->name = $request->input('name');
        $oCity->description = $request->input('description');
        $oCity->shortDescription = $request->input('short-description');
        $oCity->fk_landscape = $aParentInfo[1];
        $oCity->knownBy()->sync($aUser);

        $oCity->save();

        Session::flash('message', trans('city.updated'));
        return Redirect::to('city/' . $oCity->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        City::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('city.deleted'));
        return Redirect::to('/');
    }
}
