@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oBiome->name }}</span>
            @can('edit', $oBiome)
                <div class="pull-right">
                    <a href="{{ url('biome-edit/' . $oBiome->id) }}">
                        {{ trans('realm.edit_biome') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oBiome])

                <div class="col-md-4">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oBiome->landscape->id) }}">
                            {{ $oBiome->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oBiome])
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>{{ trans('general.tags') }}</div>
                        @include('widgets.tags', ['oObject' => $oBiome])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection