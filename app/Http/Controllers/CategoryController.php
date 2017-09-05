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
use App\Http\Requests\UpdateCategory;
use App\Item;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('create', Category::class)) {
            abort(403, 'Access Denied!');
        }

        return view('category.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create', Category::class)) {
            abort(403, 'Access Denied!');
        }

        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create', Category::class)) {
            abort(403, 'Access Denied!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name,'.$request->input('name')
        ]);

        if ($validator->fails()) {
            return redirect('category/create')->withErrors($validator)->withInput();
        }

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        Session::flash('message', 'Category Created!');
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
        if(!Gate::allows('update', Category::class)) {
            abort(403, 'Access Denied!');
        }

        return view('category.edit', ['category' => Category::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategory|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, $id)
    {
        if(!Gate::allows('update', Category::class)) {
            abort(403, 'Access Denied!');
        }

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        Session::flash('message', 'Category Updated!');
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
        if(!Gate::allows('delete', Category::class)) {
            abort(403, 'Access Denied!');
        }

        Category::find($id)->delete();

        return redirect('/category');
    }
}