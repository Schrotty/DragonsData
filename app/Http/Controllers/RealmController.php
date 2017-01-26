<?php

namespace App\Http\Controllers;

use App\User;
use App\Realm;

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

    public function index()
    {
        return view('realms', ['realms' => Realm::all()]);
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