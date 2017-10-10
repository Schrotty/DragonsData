<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Http\Requests\Store\StoreEntry;
use App\Http\Requests\Update\UpdateEntry;
use App\Party;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EntryController extends Controller
{
    public function create(Party $party)
    {
        if(!Gate::allows('writeDown', $party)) {
            abort(403, 'Access Denied!');
        }

        return view('model.party.journal.entry.create', [
            'party' => $party->id
        ]);
    }

    public function edit(Entry $entry)
    {
        if(!Gate::allows('writeDown', $entry->party)) {
            abort(403, 'Access Denied!');
        }

        return view('model.party.journal.entry.edit', [
            'entry' => $entry
        ]);
    }

    public function store(StoreEntry $request)
    {
        if(!Gate::allows('create', Party::class)) abort(403, 'Access Denied!');

        $entry = new Entry();
        $entry->author_id = Auth::id();
        $entry->party_id = $request->input('party');
        $entry->date = $request->input('date');
        $entry->title = $request->input('title');
        $entry->content = $request->input('content');
        $entry->save();

        return redirect('/party/'.$entry->party_id);
    }

    public function update(UpdateEntry $request, $id)
    {
        if(!Gate::allows('update', Entry::class)) abort(403, 'Access Denied!');

        $entry = Entry::find($id);
        $entry->fill([
            'date' => $request->input('date'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        $entry->save();
        return redirect('/party/'.$entry->party_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param int $id
     */
    public function destroy($id)
    {
        $entry = Entry::find($id);
        if(!Gate::allows('delete', $entry)) {
            abort(403, 'Access Denied!');
        }

        $entry->delete();

        return redirect('/party/' . $entry->party->id . '/edit');
    }
}
