@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Search Result</span>
        </div>

        <div class="panel-body">
            @if(count($result) != 0)
                @foreach($result as $item)
                    <div class="card w-100">
                        <div class="card-body">
                            <h4 class="card-title">{{ $item->name }}<small class="text-muted"> - {{ \App\Category::find($item->category)->name }}</small></h4>
                            <p class="card-text">{!! strip_tags(substr(addslashes($item->description), 0, 230)) !!}... <a href="item/{{$item->_id}}">Read More</a></p>
                        </div>
                    </div>
                @endforeach
            @else
                <span>Nothing found!</span>
            @endif
        </div>
    </div>
@endsection