@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oCity->name }}</span>
            @can('edit', $oCity)
                <div class="pull-right">
                    <a href="{{ url('city-edit/' . $oCity->id) }}">
                        {{ trans('realm.edit_city') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oCity])

                <div class="col-md-4">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oCity->landscape->id) }}">
                            {{ $oCity->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oCity])
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>{{ trans('general.tags') }}</div>
                        @include('widgets.tags', ['aTags' => $oCity->tags])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection