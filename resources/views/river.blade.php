@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oRiver->name }}</span>
            @can('edit', $oRiver)
                <div class="pull-right">
                    <a href="{{ url('river-edit/' . $oRiver->id) }}">
                        {{ trans('realm.edit_river') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oRiver])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oRiver->landscape->id) }}">
                            {{ $oRiver->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oRiver])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection