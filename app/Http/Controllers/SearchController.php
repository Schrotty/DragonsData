<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 13.08.2017
 * Time: 09:05
 */

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $model = "Item";
        $value = "";

        $params = explode(' ', $request->input('q'));

        foreach($params as $param) {
            if (str_contains($param, ':')) {
                $filter = explode(':', $param);

                if ($filter[0] == 'collection') {
                    $model = ucfirst($filter[1]);
                }

                continue;
            }

            $value .= $param.' ';
        }

        $collection = 'App\\'.$model;

        //db.posts.find({post_text:{$regex:"tutorialspoint"}})
        //$result = $collection::all()->where('name', 'like', trim($value, ' '))->all();
        $result = Item::all()->where('name', 'like', $value);

        if ($value == '' || $value == null) {
            $result = $collection::all();
        }

        return view('search', ['result' => $result]);
    }
}