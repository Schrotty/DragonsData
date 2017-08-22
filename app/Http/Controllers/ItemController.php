<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Events\AccessGrantedEvent;
use App\Events\AccessLostEvent;
use App\Events\NewsPublished;
use App\Http\Requests\StoreItem;
use App\Http\Requests\UpdateItem;
use App\Item;
use App\News;
use App\Notifications\AccessGranted;
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
     * @param  \Illuminate\Http\Request  $request
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

        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('content');
        $item->known = $request->input('known');
        $item->contributors = $request->input('contributors');
        $item->category = $request->input('category');
        $item->parents = $request->input('parents');
        $item->tags = $request->input('tags');
        $item->properties = $properties;
        $item->author = Auth::user()->_id;
        $item->save();

        Session::flash('message', 'Item Created!');
        if ($item->known != null) {
            event(new AccessGrantedEvent($item, $item->known));
        }

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

        if($request->input('key') != null) {
            foreach ($request->input('key') as $key => $value) {
                foreach(array_values(array_filter($request->input('value'))) as $nKey => $nVaue) {
                    if($key == $nKey) $properties[$value] = $nVaue;
                }
            }
        }

        if($item->known == null && $request->input('known') != null) {
            $gainAccess = $request->input('known'); //gain access
        }

        if($item->known != null && $request->input('known') == null) {
            $lostAccess = $item->known; //lost access
        }

        if($item->known != null && $request->input('known')) {
            foreach ($item->known as $known) {
                if(in_array($known, $request->input('known'))) {
                    continue;
                }

                $lostAccess[] = $known;
            }
        }

        if($request->input('known') != null && $item->known) {
            foreach ($request->input('known') as $known) {
                if (in_array($known, $item->known)) {
                    continue;
                }

                $gainAccess[] = $known;
            }
        }

        $item->name = $request->input('name');
        $item->description = $request->input('content');
        $item->known = $request->input('known');
        $item->contributors = $request->input('contributors');
        $item->category = $request->input('category');
        $item->parents = $request->input('parents');
        $item->tags = $request->input('tags');
        $item->properties = $properties;
        $item->save();

        event(new AccessGrantedEvent($item, $gainAccess));
        event(new AccessLostEvent($item, $lostAccess));

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