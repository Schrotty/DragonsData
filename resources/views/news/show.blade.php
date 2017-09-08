@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-body">
            @if(!empty($news))
                <div class="news-container">
                    <h2 class="news-title">
                        {{$news->title}}
                    </h2>

                    <small class="text-muted"><strong>{{ \App\User::find($news->author)->username }}</strong> - <em>{{$news->date}}</em></small>
                    @php $parsedown = new Parsedown() @endphp
                    {!! $parsedown->text($news->content) !!}
                </div>
            @endif
        </div>
    </div>
@endsection