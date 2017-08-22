<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\News;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('create', User::class)) {
            abort(403, 'Access Denied!');
        }

        return view('user.index', ['user' => User::all()]);
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

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('create', User::class)) {
            abort(403, 'Access Denied!');
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users,username,'.$request->input('username')
        ]);

        if ($validator->fails()) {
            return redirect('user/create')->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->username = $request->input('username');
        $user->group = $request->input('group');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        Session::flash('message', 'User Created!');
        //event(new NewsPublished($news));

        return Redirect::to('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!Gate::allows('view', $user)) {
            abort(403, 'Access Denied!');
        }

        return view('user.show', ['user' => $user]);
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

        return view('user.edit', ['user' => User::find($id)]);
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
        if(!Gate::allows('update', User::class)) {
            abort(403, 'Access Denied!');
        }

        $user = User::find($id);
        $user->username = $request->input('username');
        $user->group = $request->input('group');
        $user->save();

        Session::flash('message', 'User Updated!');
        return Redirect::to('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('delete', User::class)) {
            abort(403, 'Access Denied!');
        }

        User::find($id)->delete();

        return redirect('/user');
    }
}