<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObject;
use App\Http\Requests\UpdateObject;
use App\Models\Landmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class LandmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.landmark.index', ['aObjects' => Landmark::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.landmark.create', ['sMethod' => 'POST', 'oObject' => new Landmark()]);
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
        $aTags = $request->input('tags') == null ? array() : $request->input('tags');

        $aParentInfo = explode('-', $request->input('landscape'));

        $oLandmark = new Landmark();
        $oLandmark->name = $request->input('name');
        $oLandmark->description = $request->input('description');
        $oLandmark->shortDescription = $request->input('short-description');
        $oLandmark->url = parent::createURL('realm', $oLandmark->name);
        $oLandmark->fk_landscape = $aParentInfo[1];
        $oLandmark->save();

        Landmark::where('url', $oLandmark->url)->get()->first()->knownBy()->sync($aUser);
        Landmark::where('url', $oLandmark->url)->get()->first()->tags()->sync($aTags);

        Session::flash('message', trans('landmark.created'));
        return Redirect::to('landmark/' . $oLandmark->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.landmark.show', ['oObject' => Landmark::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.landmark.edit', ['oObject' => Landmark::where('url', $sURL)->get()->first()]);
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
        $aTags = $request->input('tags') == null ? array() : $request->input('tags');

        $aParentInfo = explode('-', $request->input('landscape'));

        $oLandmark = Landmark::where('url', $sURL)->get()->first();
        $oLandmark->name = $request->input('name');
        $oLandmark->description = $request->input('description');
        $oLandmark->shortDescription = $request->input('short-description');
        $oLandmark->fk_landscape = $aParentInfo[1];
        $oLandmark->knownBy()->sync($aUser);
        $oLandmark->tags()->sync($aTags);

        $oLandmark->save();

        Session::flash('message', trans('landmark.updated'));
        return Redirect::to('landmark/' . $oLandmark->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Landmark::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('landmark.deleted'));
        return Redirect::to('/');
    }
}
