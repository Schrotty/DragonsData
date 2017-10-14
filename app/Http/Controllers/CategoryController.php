<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Store\StoreCategory;
use App\Http\Requests\Update\UpdateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

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

        return view('model.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategory|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        if(!Gate::allows('create', Category::class)) {
            abort(403, 'Access Denied!');
        }

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return Redirect::to('/admin/categories');
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

        return view('model.category.edit', ['category' => Category::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategory $request
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

        return Redirect::to('/admin/categories');
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