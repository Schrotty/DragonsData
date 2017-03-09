<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObject;
use App\Http\Requests\UpdateObject;
use App\Models\Ocean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class OceanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.ocean.index', ['aObjects' => Ocean::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.ocean.create', ['sMethod' => 'POST', 'oObject' => new Ocean()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreObject|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreObject $request)
    {
        $aUser = $request->input('known-by') == null ? array() : $request->input('known-by');
        $aParentInfo = explode('-', $request->input('realm'));

        $oOcean = new Ocean();
        $oOcean->name = $request->input('name');
        $oOcean->description = $request->input('description');
        $oOcean->shortDescription = $request->input('short-description');
        $oOcean->url = parent::createURL('realm', $oOcean->name);
        $oOcean->fk_realm = $aParentInfo[1];
        $oOcean->save();

        Ocean::where('url', $oOcean->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('ocean.created'));
        return Redirect::to('ocean/' . $oOcean->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.ocean.show', ['oObject' => Ocean::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.ocean.edit', ['oObject' => Ocean::where('url', $sURL)->get()->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateObject|Request $request
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateObject $request, $sURL)
    {
        $aUser = $request->input('known-by') == null ? array() : $request->input('known-by');
        $aParentInfo = explode('-', $request->input('realm'));

        $oOcean = Ocean::where('url', $sURL)->get()->first();
        $oOcean->name = $request->input('name');
        $oOcean->description = $request->input('description');
        $oOcean->shortDescription = $request->input('short-description');
        $oOcean->fk_realm = $aParentInfo[1];
        $oOcean->knownBy()->sync($aUser);

        $oOcean->save();

        Session::flash('message', trans('ocean.updated'));
        return Redirect::to('ocean/' . $oOcean->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Ocean::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('ocean.deleted'));
        return Redirect::to('/');
    }
}
