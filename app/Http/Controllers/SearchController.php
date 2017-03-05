<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 27.02.2017
 * Time: 15:17
 */

namespace App\Http\Controllers;

use Elasticsearch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
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
                        'fields' => [
                            'name', '_type'
                        ]
                    ]
                ]
            ]
        ];

        $response = Elasticsearch::search($params);
        return view('search', ['aResults' => $response['hits']]);
    }
}