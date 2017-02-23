@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('general.island_continent') }}</div>
        <span>
            {{ App('debugbar')->info($oObject) }}
            <a href="{{ url($oObject->parent->getModel() . '/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('city.assigned') }}</span>
            @can('create', new \App\Models\City())
                <div class="pull-right">
                    <a href="{{ url('city/create/landscape/' . $oObject->url) }}">
                        {{ trans('city.add') }}
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
            <span>{{ trans('river.assigned') }}</span>
            @can('create', new \App\Models\River())
                <div class="pull-right">
                    <a href="{{ url('river/create/landscape/' . $oObject->url) }}">
                        {{ trans('river.add') }}
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
            <span>{{ trans('lake.assigned') }}</span>
            @can('create', new \App\Models\Lake())
                <div class="pull-right">
                    <a href="{{ url('lake/create/landscape/' . $oObject->url) }}">
                        {{ trans('lake.add') }}
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
            <span>{{ trans('biome.assigned') }}</span>
            @can('create', new \App\Models\Biome())
                <div class="pull-right">
                    <a href="{{ url('biome/create/landscape/' . $oObject->url) }}">
                        {{ trans('biome.add') }}
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
            <span>{{ trans('landmark.assigned') }}</span>
            @can('create', new \App\Models\Landmark())
                <div class="pull-right">
                    <a href="{{ url('landmark/create/landscape/' . $oObject->url) }}">
                        {{ trans('landmark.add') }}
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
            <span>{{ trans('mountain.assigned') }}</span>
            @can('create', new \App\Models\Mountain())
                <div class="pull-right">
                    <a href="{{ url('mountain/create/landscape/' . $oObject->url) }}">
                        {{ trans('mountain.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Mountain::all()])
        </div>
    </div>
@endsection