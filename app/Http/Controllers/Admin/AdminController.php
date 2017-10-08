<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function items(Request $request)
    {
        if (is_null($request->input('q'))) {
            return view('admin.page.items', ['items' => Item::paginate(config('app.pagination'))]);
        }

        return view('admin.page.items', [
            'items' => Item::where('name', 'like', '%'.$request->input('q').'%')->paginate(config('app.pagination')),
            'q' => $request->input('q')
        ]);
    }

    public function meta(Request $request)
    {
        if (is_null($request->input('q'))) {
            return view('admin.page.meta');
        }
    }
}
