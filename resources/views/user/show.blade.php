@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Known Items</span>
        </div>

        <div class="panel-body">
            @if(!empty($user->accessible()))
                <div class="row">
                    <div class="col-md-12 text-right">
                        <form action="/find" method="POST">
                            {{ method_field('POST') }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="input-group">
                                <div class="input-group-btn" style="width: 100%">
                                    <select name="target" class="selectpicker" data-live-search="true">
                                        @foreach($user->accessible() as $item)
                                            <option value="{{ $item->_id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input class="btn-default btn" type="submit" value="Open">
                            </div>
                        </form>
                    </div>
                </div>

                @foreach($user->accessible() as $item)
                    <div class="card w-100 known-card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $item->name }}<small class="text-muted"> - {{ \App\Category::find($item->category)->name }}</small></h4>
                            <p class="card-text">{!! strip_tags(substr(addslashes($item->description), 0, 230)) !!}... <a href="/item/{{$item->_id}}">Read More</a></p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection