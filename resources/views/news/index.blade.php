@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">News</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($news) != 0)
                        @foreach($news as $new)
                            <tr>
                                <td><a href="news/{{$new->_id}}">{{$new->title}}</a></td>
                                <td>{{substr(strip_tags($new->content), 0, 35)}}</td>
                                <td>{{\App\User::find($new->author)->username}}</td>
                                <td>{{$new->date}}</td>
                                <td>
                                    <form class="text-right" action="{{ 'news/'.$new->_id.'/edit' }}" method="POST">
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
                    <a href="/news/create">
                        <button type="button" class="btn btn-primary">Add News</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection