@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $realm->name }}</span>
            @can('edit', $realm)
                <div class="pull-right">
                    <a href="{{ url('realm/' . $realm->id . '/edit') }}">
                        {{ trans('realm.edit_realm') }}
                    </a>
                </div>
            @endcan
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="realm-description">
                        <div>{{ trans('general.description') }}</div>
                        <span>{{ $realm->description }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.dungeon_master') }}</div>
                        <span>
                        <a href="{{ url('user/' . $realm->gamemaster->id) }}">{{ $realm->gamemaster->name }}</a>
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
        <div class="panel-heading">{{ trans('realm.assigned_continents') }}</div>
        <div class="panel-body">
            @include('widgets.continents', ['realm' => $realm])
        </div>
    </div>
@endsection