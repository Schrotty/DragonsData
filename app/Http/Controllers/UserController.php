<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('models.user.create', ['sMethod' => 'POST', 'oObject' => new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUser|Request $request
     * @return Response
     */
    public function store(StoreUser $request)
    {
        $oSea = new User();
        $oSea->forename = $request->input('forename');
        $oSea->surname = $request->input('surname');
        $oSea->name = $request->input('name');
        $oSea->mail = $request->input('mail');
        $oSea->password = bcrypt($request->input('password'));

        $oSea->url = parent::createURL('user', $oSea->name);
        $oSea->save();

        Session::flash('message', trans('user.created'));
        return Redirect::to('user/' . $oSea->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $sURL
     * @return View
     */
    public function show($sURL)
    {
        return view('models.user.show', ['oObject' => User::where('url', $sURL)->get()->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:32|unique:user',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}
