<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreObject;
use App\Http\Requests\UpdateObject;
use App\Models\Biome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class BiomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('models.biome.index', ['aObjects' => Biome::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('models.biome.create', ['sMethod' => 'POST', 'oObject' => new Biome()]);
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

        $oBiome = new Biome();
        $oBiome->name = $request->input('name');
        $oBiome->description = $request->input('description');
        $oBiome->shortDescription = $request->input('short-description');
        $oBiome->url = parent::createURL('realm', $oBiome->name);
        $oBiome->fk_landscape = $aParentInfo[1];
        $oBiome->save();

        Biome::where('url', $oBiome->url)->get()->first()->knownBy()->sync($aUser);
        Biome::where('url', $oBiome->url)->get()->first()->tags()->sync($aTags);

        Session::flash('message', trans('biome.created'));
        return Redirect::to('biome/' . $oBiome->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function show($sURL)
    {
        return View::make('models.biome.show', ['oObject' => Biome::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function edit($sURL)
    {
        return View::make('models.biome.edit', ['oObject' => Biome::where('url', $sURL)->get()->first()]);
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

        $oBiome = Biome::where('url', $sURL)->get()->first();
        $oBiome->name = $request->input('name');
        $oBiome->description = $request->input('description');
        $oBiome->shortDescription = $request->input('short-description');
        $oBiome->fk_landscape = $aParentInfo[1];
        $oBiome->knownBy()->sync($aUser);
        $oBiome->tags()->sync($aTags);

        $oBiome->save();

        Session::flash('message', trans('biome.updated'));
        return Redirect::to('biome/' . $oBiome->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $sURL
     * @return \Illuminate\Http\Response
     */
    public function destroy($sURL)
    {
        Biome::where('url', $sURL)->get()->first()->delete();

        Session::flash('message', trans('biome.deleted'));
        return Redirect::to('/');
    }
}
