<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObject;
use App\Http\Requests\UpdateObject;
use App\Models\Empire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class EmpireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.empire.index', ['aObjects' => Empire::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.empire.create', ['sMethod' => 'POST', 'oObject' => new Empire()]);
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

        $oEmpire = new Empire();
        $oEmpire->name = $request->input('name');
        $oEmpire->description = $request->input('description');
        $oEmpire->shortDescription = $request->input('short-description');
        $oEmpire->url = parent::createURL('empire', $oEmpire->name);
        $oEmpire->fk_realm = $aParentInfo[1];
        $oEmpire->save();

        Empire::where('url', $oEmpire->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('empire.created'));
        return Redirect::to('empire/' . $oEmpire->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.empire.show', ['oObject' => Empire::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.empire.edit', ['oObject' => Empire::where('url', $sURL)->get()->first()]);
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

        $oEmpire = Empire::where('url', $sURL)->get()->first();
        $oEmpire->name = $request->input('name');
        $oEmpire->description = $request->input('description');
        $oEmpire->shortDescription = $request->input('short-description');
        $oEmpire->fk_realm = $aParentInfo[1];
        $oEmpire->knownBy()->sync($aUser);

        $oEmpire->save();

        Session::flash('message', trans('empire.updated'));
        return Redirect::to('empire/' . $oEmpire->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Empire::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('empire.deleted'));
        return Redirect::to('/');
    }
}
