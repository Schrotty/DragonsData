<?php

namespace App\Http\Controllers;

use App\Events\NewsPublished;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('create', News::class)) {
            abort(403, 'Access Denied!');
        }

        return view('news.index', ['news' => News::all()->reverse()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create', News::class)) {
            abort(403, 'Access Denied!');
        }

        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create', News::class)) {
            abort(403, 'Access Denied!');
        }

        app('debugbar')->info($request);

        $news = new News();
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->author = Auth::user()->_id;
        $news->date = date("d.m.Y");
        $news->save();

        Session::flash('message', 'News Created!');
        event(new NewsPublished($news));

        return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Gate::allows('view', News::class)) {
            abort(403, 'Access Denied!');
        }

        return view('news.show', ['news' => News::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('update', News::class)) {
            abort(403, 'Access Denied!');
        }

        return view('news.edit', ['news' => News::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Gate::allows('update', News::class)) {
            abort(403, 'Access Denied!');
        }

        $news = News::find($id);
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->save();

        Session::flash('message', 'News Updated!');
        return Redirect::to('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('delete', News::class)) {
            abort(403, 'Access Denied!');
        }

        News::find($id)->delete();

        return redirect('/news');
    }
}
