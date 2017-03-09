<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObject;
use App\Http\Requests\UpdateObject;
use App\Models\Lake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class LakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.lake.index', ['aObjects' => Lake::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.lake.create', ['sMethod' => 'POST', 'oObject' => new Lake()]);
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

        $oLake = new Lake();
        $oLake->name = $request->input('name');
        $oLake->description = $request->input('description');
        $oLake->shortDescription = $request->input('short-description');
        $oLake->url = parent::createURL('realm', $oLake->name);
        $oLake->fk_landscape = $aParentInfo[1];
        $oLake->save();

        Lake::where('url', $oLake->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('lake.created'));
        return Redirect::to('lake/' . $oLake->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.lake.show', ['oObject' => Lake::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.lake.edit', ['oObject' => Lake::where('url', $sURL)->get()->first()]);
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

        $oLake = Lake::where('url', $sURL)->get()->first();
        $oLake->name = $request->input('name');
        $oLake->description = $request->input('description');
        $oLake->shortDescription = $request->input('short-description');
        $oLake->fk_landscape = $aParentInfo[1];
        $oLake->knownBy()->sync($aUser);

        $oLake->save();

        Session::flash('message', trans('lake.updated'));
        return Redirect::to('lake/' . $oLake->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Lake::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('lake.deleted'));
        return Redirect::to('/');
    }
}
