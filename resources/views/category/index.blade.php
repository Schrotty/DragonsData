@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Categories</span>
            <small class="text-muted">High abstraction level</small>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($categories) != 0)
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form class="text-right" action="{{ 'category/'.$category->_id.'/edit' }}" method="POST">
                                    <input type="hidden" name="_method" value="GET">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <button type="submit" class="btn-empty">
                                        <span class="oi oi-pencil"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="text-right">
                <a href="/category/create">
                    <button type="button" class="btn btn-primary">Create Category</button>
                </a>
            </div>
        </div>
    </div>

    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Tags</span>
            <small class="text-muted">Specify category</small>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Style</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count(\App\Tag::all()) != 0)
                    @foreach(\App\Tag::all() as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>{{ \App\Category::find($tag->category)->name }}</td>
                            <td><span class="badge badge-pill badge-{{ $tag->style }}">{{ ucfirst($tag->style) }}</span></td>

                            <td>
                                <form class="text-right" action="{{ 'tag/'.$tag->_id.'/edit' }}" method="POST">
                                    <input type="hidden" name="_method" value="GET">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <button type="submit" class="btn-empty">
                                        <span class="oi oi-pencil"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td></td>
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

    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Properties</span>
            <small class="text-muted">Detailed information</small>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count(\App\Property::all()) != 0)
                    @foreach(\App\Property::all() as $property)
                        <tr>
                            <td>{{ $property->name }}</td>
                            <td>{{ \App\Category::find($property->category)->name }}</td>

                            <td>
                                <form class="text-right" action="{{ 'property/'.$property->_id.'/edit' }}" method="POST">
                                    <input type="hidden" name="_method" value="GET">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <button type="submit" class="btn-empty">
                                        <span class="oi oi-pencil"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="text-right">
                <a href="/property/create">
                    <button type="button" class="btn btn-primary">Create Property</button>
                </a>
            </div>
        </div>
    </div>
@endsection