<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Category;
use App\Events\NewsPublished;
use App\Http\Requests\UpdateTag;
use App\Item;
use App\News;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create', Tag::class)) {
            abort(403, 'Access Denied!');
        }

        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create', Tag::class)) {
            abort(403, 'Access Denied!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:tags,name,'.$request->input('name'),
            'category' => 'required',
            'style' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('tag/create')->withErrors($validator)->withInput();
        }

        $tag = new Tag();
        $tag->name = $request->input('name');
        $tag->category = $request->input('category');
        $tag->style = $request->input('style');
        $tag->save();

        //Session::flash('message', 'News Created!');
        //event(new NewsPublished($news));

        return Redirect::to('/category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('update', Tag::class)) {
            abort(403, 'Access Denied!');
        }

        return view('tag.edit', ['tag' => Tag::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTag $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTag $request, $id)
    {
        if(!Gate::allows('update', Tag::class)) {
            abort(403, 'Access Denied!');
        }

        $tag = Tag::find($id);

        $tag->name = $request->input('name');
        $tag->category = $request->input('category');
        $tag->style = $request->input('style');
        $tag->save();

        Session::flash('message', 'Tag Updated!');
        return Redirect::to('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('delete', Tag::class)) {
            abort(403, 'Access Denied!');
        }

        Tag::find($id)->delete();

        return redirect('/category');
    }
}