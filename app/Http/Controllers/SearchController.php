<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 27.02.2017
 * Time: 15:17
 */

namespace App\Http\Controllers;

use App\Models\Realm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    /**
     * @param Request $request
     */
    public function search(Request $request)
    {
        $sKeyword = '%' . $request->input('keyword') . '%';

        $aResults = Realm::where('name', 'like', $sKeyword)->get();

        return View::make('index', ['aObjects' => $aResults]);
    }
}