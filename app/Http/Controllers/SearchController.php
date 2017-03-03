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
     */
    public function search(Request $request)
    {
        $params = [
            'index' => 'dragons_data',
            'body' => [
                'query' => [
                    'match' => [
                        'name' => $request->input('keyword')
                    ]
                ]
            ]
        ];

        $response = Elasticsearch::search($params);

        print_r($response);

        return $response;
    }
}