<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObject;
use App\Http\Requests\UpdateObject;
use App\Models\Island;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class IslandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.island.index', ['aObjects' => Island::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.island.create', ['sMethod' => 'POST', 'oObject' => new Island()]);
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

        $aParentInfo = explode('-', $request->input('sea'));

        $oIsland = new Island();
        $oIsland->name = $request->input('name');
        $oIsland->description = $request->input('description');
        $oIsland->shortDescription = $request->input('short-description');
        $oIsland->url = parent::createURL('realm', $oIsland->name);
        $oIsland->fk_sea = $aParentInfo[1];
        $oIsland->save();

        Sea::where('url', $oIsland->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('island.created'));
        return Redirect::to('island/' . $oIsland->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.island.show', ['oObject' => Island::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.island.edit', ['oObject' => Island::where('url', $sURL)->get()->first()]);
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

        $aParentInfo = explode('-', $request->input('sea'));

        $oIsland = Island::where('url', $sURL)->get()->first();
        $oIsland->name = $request->input('name');
        $oIsland->description = $request->input('description');
        $oIsland->shortDescription = $request->input('short-description');
        $oIsland->fk_sea = $aParentInfo[1];
        $oIsland->knownBy()->sync($aUser);

        $oIsland->save();

        Session::flash('message', trans('island.updated'));
        return Redirect::to('island/' . $oIsland->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Island::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('island.deleted'));
        return Redirect::to('/');
    }
}
