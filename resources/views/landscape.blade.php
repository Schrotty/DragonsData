@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oLandscape->name }}</span>
            @can('edit', $oLandscape)
                <div class="pull-right">
                    <a href="{{ url('landscape/' . $oLandscape->id . '/edit') }}">
                        {{ trans('realm.edit_landscape') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oLandscape])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.continent') }}</div>
                        <span>
                        <a href="{{ url('continent/' . $oLandscape->continent->id) }}">
                            {{ $oLandscape->continent->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oLandscape])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- assigned large cities -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('realm.assigned_large_cities') }}</div>
        <div class="panel-body">
            @include('widgets.places.largeCities', ['aLargeCities' => $oLandscape->largeCities()])
        </div>
    </div>

    <!-- assigned medium cities -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('realm.assigned_medium_cities') }}</div>
        <div class="panel-body">
            @include('widgets.places.mediumCities', ['aMediumCities' => $oLandscape->mediumCities()])
        </div>
    </div>

    <!-- assigned small cities -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('realm.assigned_small_cities') }}</div>
        <div class="panel-body">
            @include('widgets.places.smallCities', ['aSmallCities' => $oLandscape->smallCities()])
        </div>
    </div>

    <!-- assigned places -->
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('realm.assigned_places') }}</div>
        <div class="panel-body">
            @include('widgets.places.places', ['aPlaces' => $oLandscape->places()])
        </div>
    </div>
@endsection