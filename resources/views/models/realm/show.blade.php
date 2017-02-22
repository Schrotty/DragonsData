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
            @can('create', new \App\Models\Continent())
                <div class="pull-right">
                    <a href="{{ url('continent/create/realm/' . $oObject->url) }}">
                        {{ trans('realm.add_continent') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Realm::continents($oObject), 'sTarget' => 'continent'])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('realm.assigned_oceans') }}</span>
            @can('create', new \App\Models\Ocean())
                <div class="pull-right">
                    <a href="{{ url('ocean/create/realm/' . $oObject->url) }}">
                        {{ trans('realm.add_ocean') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Realm::oceans($oObject), 'sTarget' => 'ocean'])
        </div>
    </div>
@endsection