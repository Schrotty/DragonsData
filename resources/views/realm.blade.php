@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $realm->name }}</span>
            @can('edit', $realm)
                <div class="pull-right">
                    <a href="{{ url('realm-edit/' . $realm->id) }}">
                        {{ trans('realm.edit_realm') }}
                    </a>
                </div>
            @endcan
        </div>
        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $realm])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.dungeon_master') }}</div>
                        <span>
                        <a href="{{ url('user/' . $realm->dungeonMaster->id) }}">{{ $realm->dungeonMaster->name }}</a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $realm])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- assigned continents -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('realm.assigned_continents') }}</span>
            @can('edit', $realm)
                <div class="pull-right">
                    <a href="{{ url('continent-create/' . $realm->id) }}">
                        {{ trans('realm.add_continent') }}
                    </a>
                </div>
            @endcan
        </div>
        <div class="panel-body">
            @include('widgets.continents', ['oContinents' => Auth::user()->knownContinents($realm)])
        </div>
    </div>
@endsection