@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oSmallCity->name }}</span>
            @can('edit', $oSmallCity)
                <div class="pull-right">
                    <a href="{{ url('small-city/' . $oSmallCity->id . '/edit') }}">
                        {{ trans('realm.edit_city') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oSmallCity])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oSmallCity->landscape->id) }}">
                            {{ $oSmallCity->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oSmallCity])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection