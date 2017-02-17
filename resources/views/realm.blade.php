@extends('layouts.view')

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
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('continent/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_continent') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownContinents($oObject), 'sTarget' => 'continent'])
        </div>
    </div>
@endsection