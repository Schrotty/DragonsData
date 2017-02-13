@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oMountain->name }}</span>
            @can('edit', $oMountain)
                <div class="pull-right">
                    <a href="{{ url('mountain-edit/' . $oMountain->id) }}">
                        {{ trans('realm.edit_mountain') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oMountain])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oMountain->landscape->id) }}">
                            {{ $oMountain->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oMountain])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection