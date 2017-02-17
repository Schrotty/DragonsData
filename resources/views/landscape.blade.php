@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oObject->name }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('landscape/editor/' . $oObject->url) }}">
                        {{ trans('realm.edit_landscape') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oObject])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.continent') }}</div>
                        <span>
                        <a href="{{ url('continent/' . $oObject->continent->url) }}">
                            {{ $oObject->continent->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oObject])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- assigned cities -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_cities') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('city/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_city') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownCities($oObject), 'sTarget' => 'city'])
        </div>
    </div>

    <!-- assigned rivers -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_rivers') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('river/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_river') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownRivers($oObject), 'sTarget' => 'river'])
        </div>
    </div>

    <!-- assigned lakes -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_lakes') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('lake/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_lake') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownLakes($oObject), 'sTarget' => 'lake'])
        </div>
    </div>

    <!-- assigned biomes -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_biomes') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('biome/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_biome') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownBiomes($oObject), 'sTarget' => 'biome'])
        </div>
    </div>

    <!-- assigned landmarks -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_landmarks') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('landmark/creator/' . $oObject->id) }}">
                        {{ trans('realm.add_landmark') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownLandmarks($oObject), 'sTarget' => 'landmark'])
        </div>
    </div>

    <!-- assigned mountains -->
    <div class="panel panel-default">
        <div class="panel-heading"><span>{{ trans('realm.assigned_mountains') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('mountain/creator/' . $oObject->id) }}">
                        {{ trans('realm.add_mountain') }}
                    </a>
                </div>
            @endcan</div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownMountains($oObject), 'sTarget' => 'mountain'])
        </div>
    </div>
@endsection