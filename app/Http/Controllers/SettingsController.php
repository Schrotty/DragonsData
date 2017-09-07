<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Category;
use App\Property;
use App\Settings;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, $id)
    {
        $metas = array(
            Category::class => 'categories',
            Tag::class => 'tags',
            Property::class => 'properties'
        );

        if(!Gate::allows('update', Settings::class)) {
            abort(403, 'Access Denied!');
        }

        foreach ($metas as $key => $meta) {
            foreach($key::all() as $mta) {
                if ($request->input($meta) != null) {
                    $mta->protected = in_array($mta->_id, $request->input($meta));
                    $mta->save();

                    continue;
                }

                $mta->protected = false;
                $mta->save();
            }
        }

        $settings = Settings::find($id);
        $settings->playerIdentifier = $request->input('player-identifier');
        $settings->save();

        Session::flash('message', 'Settings Updated!');
        return Redirect::to('/settings');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $id
     */
    public function index()
    {
        $settings = Settings::all()->where('type', '=', 'system')->first();
        if(!Gate::allows('view', $settings)) {
            abort(403, 'Access Denied!');
        }

        return \view('settings', ['settings' => $settings]);
    }
}