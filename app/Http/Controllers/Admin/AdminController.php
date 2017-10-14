<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Item;
use App\Party;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function before(Request $request, string $page, string $model)
    {
        if (is_null($request->input('q'))) {
            return view('admin.page.' . $page, ['objects' => $model::paginate(config('app.pagination'))]);
        }

        return view('admin.page.' . $page, [
            'objects' => $model::where('name', 'like', '%'.$request->input('q').'%')->paginate(config('app.pagination')),
            'q' => $request->input('q')
        ]);
    }

    public function items(Request $request)
    {
        return $this->before($request, 'items', 'App\Item');
    }

    public function parties(Request $request)
    {
        return $this->before($request, 'parties', 'App\Party');
    }

    public function categories(Request $request)
    {
        return $this->before($request, 'categories', 'App\Category');
    }

    public function tags(Request $request)
    {
        return $this->before($request, 'tags', 'App\Tag');
    }

    public function properties(Request $request)
    {
        return $this->before($request, 'properties', 'App\Property');
    }
}
