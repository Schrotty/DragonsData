@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('sea.sea') }}</div>
        <span>
            <a href="{{ url('sea/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('landscape.assigned_landscapes') }}</span>
            @if($oObject->sea->ocean->realm->isDungeonMaster(Auth::user()))
                <div class="pull-right">
                    <a href="{{ url('landscape/create/' . $oObject->url) }}">
                        {{ trans('landscape.add_landscape') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Landscape::all(), 'sTarget' => 'landscape'])
        </div>
    </div>
@endsection