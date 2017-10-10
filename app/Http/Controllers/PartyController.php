<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StoreParty;
use App\Http\Requests\Update\UpdateParty;
use App\Item;
use App\Party;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::guest()) abort(403, 'Access Denied!');
        return view('model.party.index', ['parties' => Auth::user()->parties()->paginate(config('app.pagination'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create', Party::class)) {
            abort(403, 'Access Denied!');
        }

        return view('model.party.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreParty|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreParty $request)
    {
        if(!Gate::allows('create', Party::class)) abort(403, 'Access Denied!');

        $party = new Party();
        $party->name = $request->input('name');
        $party->description = $request->input('description');
        $party->author_id = Auth::id();
        $party->chronist_id = $request->input('chronist');
        $party->save();

        foreach ($request->input('member', array()) as $member) $party->member()->save(User::find($member));
        foreach ($request->input('character', array()) as $char) $party->characters()->save(Item::find($char));

        return Redirect::to('/party/'.$party->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->exists(Party::class, $id);

        $party = Party::find($id);
        if(!Gate::allows('view', $party)) {
            abort(403, 'Access Denied!');
        }

        return view('model.party.show', ['party' => $party]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $party = Party::find($id);
        if(!Gate::allows('update', $party)) {
            abort(403, 'Access Denied!');
        }

        return view('model.party.edit', ['party' => $party]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateParty $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParty $request, $id)
    {
        $party = Party::find($id);

        if(!Gate::allows('update', $party)) abort(403, 'Access Denied!');

        $party->name = $request->input('name');
        $party->description = $request->input('description');
        $party->author_id = Auth::id();
        $party->chronist_id = $request->input('chronist');
        $party->save();

        foreach ($request->input('member', array()) as $member) $party->member()->save(User::find($member));
        foreach ($request->input('character', array()) as $char) $party->characters()->save(Item::find($char));

        return Redirect::to('/party/' . $party->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Party::find($id);
        if(!Gate::allows('delete', $party)) {
            abort(403, 'Access Denied!');
        }

        $party = Party::find($id);
        debugbar()->info($party);
        $item = Item::find($party->journal);

        if($item != null) $item->delete();
        $party->delete();

        return redirect('/party');
    }
}
