<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\NewsPublished;
use App\Item;
use App\Journal;
use App\News;
use App\Party;
use App\Policies\PartyPolicy;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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

        if (is_null($request->input('q'))) {
            return view('model.party.index', ['parties' => Auth::user()->parties()->paginate(config('app.pagination'))]);
        }

        return view('model.party.index', [
            'parties' => Auth()->user()->parties()->where('name', 'regexp', '/.*'.$request->input('q').'/i')->paginate(config('app.pagination')),
            'q' => $request->input('q')
        ]);
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

        return view('party.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create', Party::class)) {
            abort(403, 'Access Denied!');
        }

        $party = new Party();
        $party->name = $request->input('name');
        $party->member = $request->input('member');
        $party->player = $request->input('player');
        $party->chronist = $request->input('chronist');
        $party->creator = Auth::user()->_id;
        $party->description = $request->input('description');
        $party->date = date("d.m.Y");

        $journal = new Journal();
        $journal->description = null;
        $journal->save();

        $party->journal = $journal->_id;
        $party->createAndNotify();

        $journal->party = $party->id;
        $journal->save();

        Session::flash('message', 'Party Created!');
        return Redirect::to('/party/'.$party->_id);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $old = Party::find($id);
        if(!Gate::allows('update', $old)) {
            abort(403, 'Access Denied!');
        }

        $party = Party::find($id);
        $party->name = $request->input('name');
        $party->member = $request->input('member');
        $party->player = $request->input('player');
        $party->chronist = $request->input('chronist');
        $party->description = $request->input('description');
        $party->updateAndNotify($old);

        Session::flash('message', 'Party Updated!');
        return Redirect::to('/party/' . $party->_id);
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
