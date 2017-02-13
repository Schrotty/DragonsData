@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oLandscape->name }}</span>
            @can('edit', $oLandscape)
                <div class="pull-right">
                    <a href="{{ url('landscape-edit/' . $oLandscape->id) }}">
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

    <!-- assigned cities -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_cities') }}</span>
            @can('edit', $oLandscape)
                <div class="pull-right">
                    <a href="{{ url('city-create/' . $oLandscape->id) }}">
                        {{ trans('realm.add_city') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.places.cities', ['aCities' => Auth::user()->knownCities($oLandscape)])
        </div>
    </div>

    <!-- assigned rivers -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_rivers') }}</span>
            @can('edit', $oLandscape)
                <div class="pull-right">
                    <a href="{{ url('river-create/' . $oLandscape->id) }}">
                        {{ trans('realm.add_river') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.places.rivers', ['aRivers' => Auth::user()->knownRivers($oLandscape)])
        </div>
    </div>

    <!-- assigned lakes -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_lakes') }}</span>
            @can('edit', $oLandscape)
                <div class="pull-right">
                    <a href="{{ url('lake-create/' . $oLandscape->id) }}">
                        {{ trans('realm.add_lake') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.places.lakes', ['aLakes' => Auth::user()->knownLakes($oLandscape)])
        </div>
    </div>

    <!-- assigned biomes -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_biomes') }}</span>
            @can('edit', $oLandscape)
                <div class="pull-right">
                    <a href="{{ url('biome-create/' . $oLandscape->id) }}">
                        {{ trans('realm.add_biome') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownBiomes($oLandscape), 'sTarget' => 'biome'])
        </div>
    </div>

    <!-- assigned landmarks -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_landmarks') }}</span>
            @can('edit', $oLandscape)
                <div class="pull-right">
                    <a href="{{ url('landmark-create/' . $oLandscape->id) }}">
                        {{ trans('realm.add_landmark') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownLandmarks($oLandscape), 'sTarget' => 'landmark'])
        </div>
    </div>

    <!-- assigned mountains -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_mountains') }}</span>
            @can('edit', $oLandscape)
                <div class="pull-right">
                    <a href="{{ url('mountain-create/' . $oLandscape->id) }}">
                        {{ trans('realm.add_mountain') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownMountains($oLandscape), 'sTarget' => 'mountain'])
        </div>
    </div>
@endsection