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
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MaintenanceController  extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(!Auth::user()->isRoot()) {
            abort(403, 'Access Denied!');
        }

        return view('maintenance.edit', ['message' => Settings::maintainMessage()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategory|Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request)
    {
        if(!Auth::user()->isRoot()) {
            abort(403, 'Access Denied!');
        }

        $settings = Settings::getSetings();
        $settings->mmessage = $request->input('message');
        $settings->save();

        return Redirect::to('/settings');
    }

    public function changeStatus(Request $request)
    {
        if(!Auth::user()->isRoot()) {
            abort(403, 'Access Denied!');
        }

        if (App::isDownForMaintenance() == false) {
            Artisan::call('down');

            if (!Settings::isWhitelisted($request->getClientIp())) return \redirect('');
            return \view('settings', ['settings' => Settings::getSetings()]);
        }

        Artisan::call('up');
        return \view('settings', ['settings' => Settings::getSetings()]);
    }
}