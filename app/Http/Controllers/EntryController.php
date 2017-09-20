<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EntryController extends Controller
{
    public function create(Party $party)
    {
        if(!Gate::allows('writeDown', $party)) {
            abort(403, 'Access Denied!');
        }

        return view('model.party.journal.entry.create', [
            'party' => $party->_id
        ]);
    }

    public function edit(Entry $entry)
    {
        if(!Gate::allows('writeDown', Party::find($entry->getValue('party')))) {
            abort(403, 'Access Denied!');
        }

        return view('model.party.journal.entry.edit', [
            'entry' => $entry
        ]);
    }

    public function store(Request $request)
    {
        if(!Gate::allows('create', Party::class)) {
            abort(403, 'Access Denied!');
        }

        $entry = Entry::create([
            'author' => \Illuminate\Support\Facades\Auth::id(),
            'party' => $request->input('party'),
            'date' => $request->input('date'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect('/party/'.$entry->party);
    }

    public function update(Request $request, $id)
    {
        if(!Gate::allows('update', Entry::class)) {
            abort(403, 'Access Denied!');
        }

        $entry = Entry::find($id);
        $entry->fill([
            'date' => $request->input('date'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        $entry->save();
        return redirect('/party/'.$entry->party);
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

        return redirect('/party/' . $entry->getValue('party') . '/edit');
    }
}
