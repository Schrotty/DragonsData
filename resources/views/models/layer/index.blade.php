@extends('layouts.app')

@section('content')
    @foreach($aObjects as $oObject)
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>{{ $oObject->name }}</span>
            </div>

            <div class="panel-body">
                <p>{{ $oObject->description }}</p>
                @include('widget.realms', ['realms' => \App\Models\Layer::childObjects($oObject)])
            </div>
        </div>
    @endforeach
@endsection
