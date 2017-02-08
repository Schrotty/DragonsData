@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oPlace->name }}</span>
            @can('edit', $oPlace)
                <div class="pull-right">
                    <a href="{{ url('place/' . $oPlace->id . '/edit') }}">
                        {{ trans('realm.edit_place') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oPlace])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oPlace->landscape->id) }}">
                            {{ $oPlace->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oPlace])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection