<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 27.02.2017
 * Time: 15:17
 */

namespace App\Http\Controllers;

use App\Models\Realm;
use Elasticsearch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public static function index()
    {
        $oRealm = Realm::find(1);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $params = [
            'index' => 'dragons_data',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $request->input('keyword'),
                        'type' => 'phrase_prefix',
                        'fields' => [
                            'name', '_type'
                        ]
                    ]
                ]
            ]
        ];

        $response = Elasticsearch::search($params);
        return view('search', ['aResults' => $response['hits'], 'sQuery' => $request->input('keyword')]);
    }
}