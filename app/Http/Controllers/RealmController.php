<?php

namespace App\Http\Controllers;

use App\Models\Realm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class RealmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.realm.index', ['aObjects' => Realm::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.realm.create', ['sMethod' => 'POST', 'oObject' => new Realm()]);
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
            'dungeon-master'    => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()){
            return Redirect::to('realm/create')->withErrors($oValidator)->withInput();
        }

        $aParentInfo = explode('-', $request->input('dungeon-master'));

        $oRealm = new Realm();
        $oRealm->name = $request->input('name');
        $oRealm->description = $request->input('description');
        $oRealm->shortDescription = $request->input('short-description');
        $oRealm->fk_creator = Auth::user()->id;
        $oRealm->fk_dungeonMaster = $aParentInfo[1];
        $oRealm->url = parent::createURL('realm', $oRealm->name);
        $oRealm->isOpen = $request->input('is-open') == true ? 1 : 0;
        $oRealm->save();

        Realm::where('url', $oRealm->url)->get()->first()->knownBy()->sync($aUser);

        Session::flash('message', trans('realm.created'));
        return Redirect::to('realm/' . $oRealm->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.realm.show', ['oObject' => Realm::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.realm.edit', ['oObject' => Realm::where('url', $sURL)->get()->first()]);
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
            'dungeon-master'    => 'required'
        );

        $oValidator = Validator::make($request->all(), $aRules);

        if ($oValidator->fails()){
            return Redirect::to('realm/edit')->withErrors($oValidator)->withInput();
        }

        $aParentInfo = explode('-', $request->input('dungeon-master'));

        $oRealm = Realm::where('url', $sURL)->get()->first();
        $oRealm->name = $request->input('name');
        $oRealm->description = $request->input('description');
        $oRealm->shortDescription = $request->input('short-description');
        $oRealm->fk_creator = Auth::user()->id;
        $oRealm->fk_dungeonMaster = $aParentInfo[1];
        $oRealm->isOpen = $request->input('is-open') == true ? 1 : 0;
        $oRealm->knownBy()->sync($aUser);

        $oRealm->save();

        Session::flash('message', trans('realm.updated'));
        return Redirect::to('realm/' . $oRealm->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Realm::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('realm.deleted'));
        return Redirect::to('/');
    }
}
