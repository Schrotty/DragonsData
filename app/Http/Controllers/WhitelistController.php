<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\NewsPublished;
use App\Item;
use App\Journal;
use App\News;
use App\Party;
use App\Policies\PartyPolicy;
use App\Settings;
use App\User;
use App\Whitelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class WhitelistController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create', Settings::class)) {
            abort(403, 'Access Denied!');
        }

        return view('whitelist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create', Settings::class)) {
            abort(403, 'Access Denied!');
        }

        $entry = new Whitelist();
        $entry->ip = $request->input('ip');
        $entry->description = $request->input('description');
        $entry->save();

        Session::flash('message', 'Entry Created!');
        return Redirect::to('/settings');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('update', Settings::class)) {
            abort(403, 'Access Denied!');
        }

        return view('whitelist.edit', ['entry' => Whitelist::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Gate::allows('create', Party::class)) {
            abort(403, 'Access Denied!');
        }

        $entry = Whitelist::find($id);
        $entry->ip = $request->input('ip');
        $entry->description = $request->input('description');
        $entry->save();

        Session::flash('message', 'Entry Updated!');
        return Redirect::to('/settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('delete', Settings::class)) {
            abort(403, 'Access Denied!');
        }

        Whitelist::find($id)->delete();
        //$party->delete();

        return redirect('/settings');
    }
}
