@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oLandmark->name }}</span>
            @can('edit', $oLandmark)
                <div class="pull-right">
                    <a href="{{ url('landmark-edit/' . $oLandmark->id) }}">
                        {{ trans('realm.edit_landmark') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oLandmark])

                <div class="col-md-4">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oLandmark->landscape->id) }}">
                            {{ $oLandmark->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oLandmark])
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>{{ trans('general.tags') }}</div>
                        @include('widgets.tags', ['oObject' => $oLandmark])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection