<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObject;
use App\Http\Requests\UpdateObject;
use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class MountainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.mountain.index', ['aObjects' => Mountain::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.mountain.create', ['sMethod' => 'POST', 'oObject' => new Mountain()]);
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

        $oMountain = new Mountain();
        $oMountain->name = $request->input('name');
        $oMountain->description = $request->input('description');
        $oMountain->shortDescription = $request->input('short-description');
        $oMountain->url = parent::createURL('realm', $oMountain->name);
        $oMountain->fk_landscape = $aParentInfo[1];
        $oMountain->save();

        Mountain::where('url', $oMountain->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('mountain.created'));
        return Redirect::to('mountain/' . $oMountain->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.mountain.show', ['oObject' => Mountain::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.mountain.edit', ['oObject' => Mountain::where('url', $sURL)->get()->first()]);
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

        $oMountain = Mountain::where('url', $sURL)->get()->first();
        $oMountain->name = $request->input('name');
        $oMountain->description = $request->input('description');
        $oMountain->shortDescription = $request->input('short-description');
        $oMountain->fk_landscape = $aParentInfo[1];
        $oMountain->knownBy()->sync($aUser);

        $oMountain->save();

        Session::flash('message', trans('mountain.updated'));
        return Redirect::to('mountain/' . $oMountain->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Mountain::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('mountain.deleted'));
        return Redirect::to('/');
    }
}
