@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oLargeCity->name }}</span>
            @can('edit', $oLargeCity)
                <div class="pull-right">
                    <a href="{{ url('large-city/' . $oLargeCity->id . '/edit') }}">
                        {{ trans('realm.edit_city') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oLargeCity])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oLargeCity->landscape->id) }}">
                            {{ $oLargeCity->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oLargeCity])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection