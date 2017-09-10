@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Categories</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @if(count($categories) != 0)
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <form class="text-right" action="{{ 'category/'.$category->_id }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <button type="submit" class="btn-empty">
                                        <span class="oi oi-trash"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="text-right">
                <a href="/category/create">
                    <button type="button" class="btn btn-primary">Create Catgory</button>
                </a>
            </div>
        </div>
    </div>

    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Tags</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Style</th>
                </tr>
                </thead>
                <tbody>
                @if(count(\App\Tag::all()) != 0)
                    @foreach(\App\Tag::all() as $tag)
                        <tr>
                            <td>
                                {{ $tag->name }}
                                {{ \App\Category::find($tag->category)->name }}
                                {{ $tag->style }}
                            </td>
                            <td>
                                <form class="text-right" action="{{ 'tag/'.$tag->_id }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <button type="submit" class="btn-empty">
                                        <span class="oi oi-trash"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="text-right">
                <a href="/tag/create">
                    <button type="button" class="btn btn-primary">Create Tag</button>
                </a>
            </div>
        </div>
    </div>
@endsection