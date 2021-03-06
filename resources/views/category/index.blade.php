@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Categories</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover data-table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($categories) != 0)
                    @foreach($categories as $category)
                        @if($category != null)
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
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="/category/create">
                        <button type="button" class="btn btn-primary">Add Category</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Tags</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover data-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <!--<th>Style</th>-->
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count(\App\Tag::all()) != 0)
                    @foreach(\App\Tag::all() as $tag)
                        @if($tag != null)
                            <tr>
                                <td>{{ $tag->name }}</td>

                                @php $category = \App\Category::find($tag->category)  @endphp
                                <td>{{ $category == null ? 'Unknown' : $category->name }}</td>

                                <!--<td><span class="badge badge-pill badge-{{ $tag->style }}">{{ $tag->name }}</span></td>-->

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
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <!--<td>-</td>-->
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="/tag/create">
                        <button type="button" class="btn btn-primary">Add Tag</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Properties</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover data-table">
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
                        @if($property != null)
                            <tr>
                                <td>{{ $property->name }}</td>

                                @php $category = \App\Category::find($property->category)  @endphp
                                <td>{{ $category == null ? 'Unknown' : $category->name }}</td>

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
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="/property/create">
                        <button type="button" class="btn btn-primary">Add Property</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection