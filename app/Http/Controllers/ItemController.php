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

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('create', Item::class)) {
            abort(403, 'Access Denied!');
        }

        return view('item.index', ['items' => Item::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create', Item::class)) {
            abort(403, 'Access Denied!');
        }

        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreItem|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItem $request)
    {
        if(!Gate::allows('create', Item::class)) {
            abort(403, 'Access Denied!');
        }

        $properties = array();
        if ($request->input('key') != null) {
            foreach ($request->input('key') as $key => $value) {
                foreach(array_values(array_filter($request->input('value'))) as $nKey => $nVaue) {
                    if($key == $nKey) $properties[$value] = $nVaue;
                }
            }
        }

        $known = array();
        foreach ($request->input('known') as $id){
            if (User::isUser($id)) {
                $known[] = $id;
                continue;
            }

            if (Party::isParty($id)) {
                $known = array_merge($known, Party::find($id)->member);
            }
        }

        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('content');
        $item->teaser = substr($request->input('teaser'), 0, 50);
        $item->known = $known;
        $item->contributors = $request->input('contributors');
        $item->category = $request->input('category');
        $item->parents = $request->input('parents');
        $item->tags = $request->input('tags');
        $item->properties = empty($properties) ? null : $properties;
        $item->author = Auth::user()->_id;
        $item->party = $request->input('party');
        $item->save();

        Session::flash('message', 'Item Created!');
        if ($item->known != null) foreach ($item->known as $user) User::find($user)->notify(new AccessGranted($item));
        if ($item->contributors != null) foreach ($item->contributors as $user) User::find($user)->notify(new ContributorRightsGranted($item));

        return Redirect::to('/item/'.$item->_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        if ($item == null) abort(404);

        if(!Gate::allows('view', $item)) {
            abort(403, 'Access Denied!');
        }

        return view('item.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        if(!Gate::allows('update', $item)) {
            abort(403, 'Access Denied!');
        }

        return view('item.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItem $request
     * @param $id
     * @return mixed
     */
    public function update(UpdateItem $request, $id)
    {
        $item = Item::find($id);
        if(!Gate::allows('update', $item)) {
            abort(403, 'Access Denied!');
        }

        $properties = array();
        $gainAccess = array();
        $lostAccess = array();

        $gainRights = array();
        $lostRights = array();

        $knwn = array();
        foreach ($request->input('known') ?? array() as $id){
            if (User::exist($id)) {
                $knwn[] = $id;
                continue;
            }

            if (Party::exist($id)) {
                $knwn = array_merge($knwn, Party::find($id)->member);
            }
        }

        $knwn = array_unique($knwn);

        if($request->input('key') != null) {
            foreach ($request->input('key') as $key => $value) {
                foreach(array_values(array_filter($request->input('value'))) as $nKey => $nVaue) {
                    if($key == $nKey) $properties[$value] = $nVaue;
                }
            }
        }

        if ($item->known == null) $gainAccess = $request->input('contributors');
        if ($knwn == null) $lostAccess = $item->known;
        if($item->known != null && count($item->known) != 0 && $knwn) {
            foreach ($item->known as $known) {
                if(!in_array($known, $knwn)) $lostAccess[] = $known;
            }

            foreach ($knwn as $known) {
                if (!in_array($known, $item->known)) $gainAccess[] = $known;
            }
        }

        if ($item->contributors == null) $gainRights = $request->input('contributors');
        if ($request->input('contributors') == null) $lostRights = $item->contributors;
        if($item->contributors != null && $request->input('contributors')) {
            foreach ($item->contributors as $contri) {
                if(!in_array($contri, $request->input('contributors'))) $lostRights[] = $contri;
            }

            foreach ($request->input('contributors') as $contri) {
                if (!in_array($contri, $item->contributors)) $gainRights[] = $contri;
            }
        }

        $item->name = $request->input('name');
        $item->description = $request->input('content');
        $item->teaser = substr($request->input('teaser'), 0, 50);
        $item->known = count($knwn) != 0 ? $knwn : null;
        $item->contributors = $request->input('contributors');
        $item->category = $request->input('category');
        $item->parents = $request->input('parents');
        $item->tags = $request->input('tags');
        $item->properties = empty($properties) ? null : $properties;
        $item->party = $request->input('party');
        $item->save();

        if ($gainAccess != null) foreach ($gainAccess as $user) User::find($user)->notify(new AccessGranted($item));
        if ($lostAccess != null) foreach ($lostAccess as $user) User::find($user)->notify(new AccessLost($item));

        if ($gainRights != null) foreach ($gainRights as $user) User::find($user)->notify(new ContributorRightsGranted($item));
        if ($lostRights != null) foreach ($lostRights as $user) User::find($user)->notify(new ContributorRightsLost($item));

        Session::flash('message', 'Item Updated!');
        return Redirect::to('/item/'.$item->_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if(!Gate::allows('delete', $item)) {
            abort(403, 'Access Denied!');
        }

        $item->delete();

        return redirect('/item');
    }
}