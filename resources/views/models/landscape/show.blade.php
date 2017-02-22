@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('general.parent') }}</div>
        <span>
            {{ App('debugbar')->info($oObject) }}
            <a href="{{ url($oObject->parent->getModel() . '/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('city.assigned_cities') }}</span>
            @can('create', new \App\Models\City())
                <div class="pull-right">
                    <a href="{{ url('city/create/landscape/' . $oObject->url) }}">
                        {{ trans('city.add_city') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\City::all()])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('river.assigned_rivers') }}</span>
            @can('create', new \App\Models\River())
                <div class="pull-right">
                    <a href="{{ url('river/create/landscape/' . $oObject->url) }}">
                        {{ trans('river.add_river') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\River::all()])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('lake.assigned_lakes') }}</span>
            @can('create', new \App\Models\Lake())
                <div class="pull-right">
                    <a href="{{ url('lake/create/landscape/' . $oObject->url) }}">
                        {{ trans('lake.add_lake') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Lake::all()])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('biome.assigned_biomes') }}</span>
            @can('create', new \App\Models\Biome())
                <div class="pull-right">
                    <a href="{{ url('biome/create/landscape/' . $oObject->url) }}">
                        {{ trans('biome.add_biome') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Biome::all()])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('landmark.assigned_landmarks') }}</span>
            @can('create', new \App\Models\Landmark())
                <div class="pull-right">
                    <a href="{{ url('landmark/create/landscape/' . $oObject->url) }}">
                        {{ trans('landmark.add_landmark') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Landmark::all()])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('mountain.assigned_mountains') }}</span>
            @can('create', new \App\Models\Mountain())
                <div class="pull-right">
                    <a href="{{ url('mountain/create/landscape/' . $oObject->url) }}">
                        {{ trans('mountain.add_mountain') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Mountain::all()])
        </div>
    </div>
@endsection