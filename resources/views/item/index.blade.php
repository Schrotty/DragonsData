@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Items</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($items) != 0)
                        @foreach($items as $item)
                            <tr>
                                <td><a href="/item/{{ $item->_id }}">{{ $item->name }}</a></td>
                                <td>{{substr(strip_tags($item->description), 0, 35)}}</td>
                                <td>{{ \App\Category::find($item->category)->name }}</td>
                                <td>{{ \App\User::find($item->author)->username ?? 'Unknown' }}</td>

                                <td>
                                    <form class="text-right" action="{{ 'item/'.$item->_id.'/edit' }}" method="POST">
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
                    <a href="/item/create">
                        <button type="button" class="btn btn-primary">Create Item</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection