@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">News</span>
        </div>

        <div class="panel-body">
            @if(count($news) != 0)
                @foreach($news as $new)
                    <div class="news-container">
                        <h2 class="news-title">
                            {{$new->title}}
                        </h2>

                        <p>
                            @if(strlen($new->content) > 180)
                                {!! strip_tags(substr(addslashes($new->content), 0, 180)) !!}... <a href="news/{{$new->_id}}">Read More</a>
                            @else
                                {!! strip_tags(addslashes($new->content)) !!}
                            @endif
                        </p>
                    </div>
                @endforeach
            @else
                <span>Nothing to show here!</span>
            @endif
        </div>
    </div>
@endsection