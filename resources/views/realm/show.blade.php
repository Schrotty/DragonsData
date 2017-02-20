@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.dungeon_master') }}</div>
        <span>
            <a href="{{ url('user/' . $oObject->dungeonMaster->url) }}">{{ $oObject->dungeonMaster->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('realm.assigned_continents') }}</span>
            @if($oObject->isDungeonMaster(Auth::user()))
                <div class="pull-right">
                    <a href="{{ url('continent/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_continent') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Continent::all(), 'sTarget' => 'continent'])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('realm.assigned_oceans') }}</span>
            @if($oObject->isDungeonMaster(Auth::user()))
                <div class="pull-right">
                    <a href="{{ url('ocean/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_ocean') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Ocean::all(), 'sTarget' => 'ocean'])
        </div>
    </div>
@endsection