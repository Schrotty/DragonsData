<?php

namespace App\Http\Controllers;

use App\User;
use App\Realm;
use Illuminate\Support\Facades\Gate;

class RealmController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Gate::allows('view-realms'))
        {
            return view('realms', ['realms' => Realm::all()]);
        }

        return view('errors.503'); //TODO: create access denied view
    }

    public function single($realmId)
    {
        return view('realm', ['realm' => Realm::find($realmId)]);
    }

    public function assignUser($realmId, $userId)
    {
        Realm::find($realmId)->users()->attach(User::find($userId)->id);

        return redirect('realm/' . $realmId);
    }
}