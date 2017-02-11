@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oLake->name }}</span>
            @can('edit', $oLake)
                <div class="pull-right">
                    <a href="{{ url('lake-edit/' . $oLake->id) }}">
                        {{ trans('realm.edit_lake') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oLake])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.landscape') }}</div>
                        <span>
                        <a href="{{ url('landscape/' . $oLake->landscape->id) }}">
                            {{ $oLake->landscape->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oLake])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection