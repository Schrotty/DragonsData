@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('ocean.ocean') }}</div>
        <span>
            <a href="{{ url('ocean/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('island.assigned_islands') }}</span>
            @if($oObject->ocean->realm->isDungeonMaster(Auth::user()))
                <div class="pull-right">
                    <a href="{{ url('island/create/' . $oObject->url) }}">
                        {{ trans('sea.add_island') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Island::all(), 'sTarget' => 'island'])
        </div>
    </div>
@endsection