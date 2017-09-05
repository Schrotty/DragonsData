<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\News;
use App\Notifications\AccessGranted;
use App\Notifications\AccessLost;
use App\Notifications\ContributorRightsGranted;
use App\Notifications\ContributorRightsLost;
use App\Notifications\NewsPublish;
use App\Notifications\Notifications;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('index', User::class)) {
            abort(403, 'Access Denied!');
        }

        $user = User::all()->where('group', '>=', Auth::user()->authLevel());
        return view('user.index', ['user' => $user->sortBy('group', null, false)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create', User::class)) {
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
        $user->username = ucfirst($request->input('username'));
        $user->group = $request->input('group') ?? 2;
        $user->password = bcrypt($request->input('password'));
        $user->chars = $request->input('char');
        $user->notifications = array(
            AccessLost::class,
            AccessGranted::class,
            ContributorRightsLost::class,
            ContributorRightsGranted::class,
            NewsPublish::class
        );

        $user->save();

        Session::flash('message', 'User Created!');
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
        $user = User::all()->where('username', '=', ucfirst($id))->first();
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
        if(!Gate::allows('update', User::class)) {
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
        $user->username = ucfirst($request->input('username'));
        if (Auth::user()->isRoot())
            $user->group = $request->input('group') ?? $user->authlevel();

        $user->chars = $request->input('char');
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

    public function updateAccountDetails(Request $request, $id)
    {
        if ($request->input('type') == 'security') return $this->changePassword($request, $id);
        if ($request->input('type') == 'notification') return $this->changeNotifications($request, $id);

        return redirect('/account');
    }

    public function changePassword(Request $request, $id)
    {
        if(!Gate::allows('update', Auth::user())) {
            abort(403, 'Access Denied!');
        }

        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!Hash::check($request->input('current-password'), Auth::user()->getAuthPassword())) {
                $validator->errors()->add('current-password', 'Current password is wrong!');
            }
        });

        if ($validator->fails()) {
            return redirect('/account')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Session::flash('message', 'Password Updated!');
        return redirect('/account');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeNotifications(Request $request, $id)
    {
        if(!Gate::allows('update', Auth::user())) {
            abort(403, 'Access Denied!');
        }

        $notifications = array();
        if ($request->input('read-access') != null) $notifications = array_merge($notifications, Notifications::READ_ACCESS);
        if ($request->input('write-access') != null) $notifications = array_merge($notifications, Notifications::WRITE_ACCESS);
        if ($request->input('news') != null) $notifications[] = NewsPublish::class;

        $user = User::find($id);
        debugbar()->info($user);
        $user->notifications = $notifications;
        $user->save();

        return redirect('/account');
    }
  
    public function resetPassword($id)
    {
        $user = User::find($id);

        if(!Gate::allows('update', $user)) {
            abort(403, 'Access Denied!');
        }

        $user->password = Hash::make(strtolower($user->username));
        $user->save();

        return $this->index();
    }
}