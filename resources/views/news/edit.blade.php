@extends('layout.app')

@section('content')
    @can('create', App\News::class)
        <div class="panel panel-default side-panel">
            <div class="panel-heading">
                <span class="panel-title">Edit News</span>
            </div>

            <div class="panel-body">
                <form action="{{ '/news/' . $news->_id }}" method="POST">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" aria-describedby="titleHelp" placeholder="Enter Title" value="{{$news->title}}">
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="mce" class="form-control" name="content" rows="3">{{$news->content}}</textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Update News</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection