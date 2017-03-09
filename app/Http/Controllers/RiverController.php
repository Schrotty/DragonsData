<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObject;
use App\Http\Requests\UpdateObject;
use App\Models\River;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class RiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.river.index', ['aObjects' => River::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.river.create', ['sMethod' => 'POST', 'oObject' => new River()]);
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
        $aParentInfo = explode('-', $request->input('landscape'));

        $oRiver = new River();
        $oRiver->name = $request->input('name');
        $oRiver->description = $request->input('description');
        $oRiver->shortDescription = $request->input('short-description');
        $oRiver->url = parent::createURL('realm', $oRiver->name);
        $oRiver->fk_landscape = $aParentInfo[1];
        $oRiver->save();

        River::where('url', $oRiver->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('river.created'));
        return Redirect::to('river/' . $oRiver->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.river.show', ['oObject' => River::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.river.edit', ['oObject' => River::where('url', $sURL)->get()->first()]);
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
        $aParentInfo = explode('-', $request->input('landscape'));

        $oRiver = River::where('url', $sURL)->get()->first();
        $oRiver->name = $request->input('name');
        $oRiver->description = $request->input('description');
        $oRiver->shortDescription = $request->input('short-description');
        $oRiver->fk_landscape = $aParentInfo[1];
        $oRiver->knownBy()->sync($aUser);

        $oRiver->save();

        Session::flash('message', trans('river.updated'));
        return Redirect::to('river/' . $oRiver->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        River::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('river.deleted'));
        return Redirect::to('/');
    }
}
