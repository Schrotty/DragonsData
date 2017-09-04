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
use App\Http\Requests\UpdateProperty;
use App\Item;
use App\News;
use App\Property;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create', Property::class)) {
            abort(403, 'Access Denied!');
        }

        return view('property.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create', Property::class)) {
            abort(403, 'Access Denied!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:properties,name,'.$request->input('name')
        ]);

        if ($validator->fails()) {
            return redirect('property/create')->withErrors($validator)->withInput();
        }

        $property = new Property();
        $property->name = $request->input('name');
        $property->category = $request->input('category');
        $property->save();

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
        $prop = Property::find($id);
        if(!Gate::allows('update', $prop)) {
            abort(403, 'Access Denied!');
        }

        return view('property.edit', ['property' => $prop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProperty|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProperty $request, $id)
    {
        $prop = Property::find($id);
        if(!Gate::allows('update', $prop)) {
            abort(403, 'Access Denied!');
        }

        $prop->name = $request->input('name');
        $prop->category = $request->input('category');
        $prop->save();

        Session::flash('message', 'Property Updated!');
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
        if(!Gate::allows('delete', Property::class)) {
            abort(403, 'Access Denied!');
        }

        Property::find($id)->delete();

        return redirect('/category');
    }
}