<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreItem;
use App\Http\Requests\UpdateItem;
use App\Item;
use App\Party;
use App\Tag;
use App\User;
use Barryvdh\Debugbar\Middleware\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class ItemController extends Controller
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
            return view('model.item.index', ['items' => Item::paginate(config('app.pagination'))]);
        }

        return view('model.item.index', [
            'items' => Item::where('name', 'regexp', '/.*'.$request->input('q').'/i')->paginate(config('app.pagination')),
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
        if(!Gate::allows('create', Item::class)) {
            abort(403, 'Access Denied!');
        }

        return view('model.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreItem|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create', Item::class)) abort(403, 'Access Denied!');

        $properties = array();
        if ($request->input('key') != null) {
            foreach ($request->input('key') as $key => $value) {
                foreach(array_values(array_filter($request->input('value'))) as $nKey => $nVaue) {
                    if($key == $nKey) $properties[$value] = $nVaue;
                }
            }
        }

        /*
            $item->properties = empty($properties) ? null : $properties;
            $item->party = $request->input('parties');
        */

        $item = new Item();
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->teaser = $request->input('teaser');
        $item->author = Auth::id();
        $item->category_id = $request->input('category');
        $item->save();

        foreach ($request->input('references', array()) as $ref) $item->references()->save(Item::find($ref));
        foreach ($request->input('tags', array()) as $tag) $item->tags()->save(Tag::find($tag));

        $userWithAccess = array_unique(array_merge($request->input('writeAccess', array()), $request->input('readAccess', array())));
        foreach ($userWithAccess as $withAccess) {
            if (in_array($withAccess, $request->input('writeAccess', array()))) {
                $item->userWithWriteAccess()->attach($withAccess, ['write_access' => true]);
                continue;
            }

            $item->userWithReadAccess()->attach($withAccess, ['write_access' => false]);
        }

        return Redirect::to('/item/'.$item->id);
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
        if(!Gate::allows('view', $item)) abort(403, 'Access Denied!');

        return view('model.item.show', ['item' => $item]);
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
        if(!Gate::allows('update', $item)) abort(403, 'Access Denied!');

        return view('model.item.edit', ['item' => $item, 'container' => $item]);
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

        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->teaser = substr($request->input('teaser'), 0, 50);
        $item->known = count($knwn) != 0 ? $knwn : null;
        $item->contributors = $request->input('contributors');
        $item->category = $request->input('category');
        $item->references = $request->input('references');
        $item->tags = $request->input('tags');
        $item->properties = empty($properties) ? null : $properties;
        $item->parties = $request->input('party');
        $item->save();

        return Redirect::to('/item/'.$item->_id);
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
        $item = Item::find($id);
        if(!Gate::allows('delete', $item)) {
            abort(403, 'Access Denied!');
        }

        $item->delete();

        return redirect('/admin/items');
    }
}