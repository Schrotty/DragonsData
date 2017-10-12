<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Item;
use App\Party;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function items(Request $request)
    {
        if (is_null($request->input('q'))) {
            return view('admin.page.items', ['objects' => Item::paginate(config('app.pagination'))]);
        }

        return view('admin.page.items', [
            'objects' => Item::where('name', 'like', '%'.$request->input('q').'%')->paginate(config('app.pagination')),
            'q' => $request->input('q')
        ]);
    }

    public function parties(Request $request)
    {
        if (is_null($request->input('q'))) {
            return view('admin.page.parties', ['objects' => Party::paginate(config('app.pagination'))]);
        }

        return view('admin.page.parties', [
           'objects' => Party::where('name', 'like', '%'. $request->input('q') .'%')->paginate(config('app.pagination')),
           'q' => $request->input('q')
        ]);
    }

    public function meta(Request $request)
    {
        if (is_null($request->input('q'))) {
            return view('admin.page.meta', ['objects' => Category::paginate(config('app.pagination'))]);
        }

        return view('admin.page.meta', [
            'objects' => Category::where('name', 'like', '%'.$request->input('q').'%')->paginate(config('app.pagination')),
            'q' => $request->input('q')
        ]);
    }
}
