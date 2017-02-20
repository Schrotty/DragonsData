@extends('layouts.view')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.dungeon_master') }}</div>
        <span>
            <a href="{{ url( $oObject->parent->getModel() . '/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')

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
            @include('widget.defaultList', ['aObjects' => Auth::user()->knownCities($oObject), 'sTarget' => 'city'])
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
            @include('widget.defaultList', ['aObjects' => Auth::user()->knownRivers($oObject), 'sTarget' => 'river'])
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
            @include('widget.defaultList', ['aObjects' => Auth::user()->knownLakes($oObject), 'sTarget' => 'lake'])
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
            @include('widget.defaultList', ['aObjects' => Auth::user()->knownBiomes($oObject), 'sTarget' => 'biome'])
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
            @include('widget.defaultList', ['aObjects' => Auth::user()->knownLandmarks($oObject), 'sTarget' => 'landmark'])
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
            @include('widget.defaultList', ['aObjects' => Auth::user()->knownMountains($oObject), 'sTarget' => 'mountain'])
        </div>
    </div>
@endsection