<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Events\NewsPublished;
use App\Http\Requests\StoreItem;
use App\Http\Requests\UpdateItem;
use App\Item;
use App\Journal;
use App\News;
use App\Notifications\AccessGranted;
use App\Notifications\AccessLost;
use App\Notifications\ContributorRightsGranted;
use App\Notifications\ContributorRightsLost;
use App\Party;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreItem|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItem $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journal = Journal::find($id);
        if(!Gate::allows('update', $journal)) {
            abort(403, 'Access Denied!');
        }

        return view('journal.edit', ['journal' => $journal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItem|Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $journal = Journal::find($id);
        if(!Gate::allows('update', $journal)) {
            abort(403, 'Access Denied!');
        }

        $journal->description = $request->input('content');
        $journal->save();

        Session::flash('message', 'Journal Updated!');
        return Redirect::to('/party/' . $journal->party);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}