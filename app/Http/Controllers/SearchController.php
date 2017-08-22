<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Events\AccessGrantedEvent;
use App\Events\AccessLostEvent;
use App\Events\NewsPublished;
use App\Item;
use App\News;
use App\Notifications\AccessGranted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        return view('seach-result', ['result' => Item::whereRaw(array('$text'=>array('$search'=> "\"" . $query . "\"")))->get()]);
    }

    public function find(Request $request)
    {
        return view('item.show', ['item' => Item::find($request->input('target'))]);
    }
}