@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oMediumCity->name }}</span>
            @can('edit', $oMediumCity)
                <div class="pull-right">
                    <a href="{{ url('medium-city/' . $oMediumCity->id . '/edit') }}">
                        {{ trans('realm.edit_city') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oMediumCity])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oMediumCity->landscape->id) }}">
                            {{ $oMediumCity->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oMediumCity])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection