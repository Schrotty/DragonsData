@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oContinent->name }}</span>
            @can('edit', $oContinent)
                <div class="pull-right">
                    <a href="{{ url('continent-edit/' . $oContinent->id) }}">
                        {{ trans('realm.edit_continent') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oContinent])

                <div class="col-md-6">
                    <div class="realm-gamemaster">
                        <div>{{ trans('realm.realm') }}</div>
                        <span>
                        <a href="{{ url('realm/' . $oContinent->realm->id) }}">
                            {{ $oContinent->realm->name }}
                        </a>
                    </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oContinent])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- assigned landscapes -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('realm.assigned_landscapes') }}</span>
            @can('edit', $oContinent)
                <div class="pull-right">
                    <a href="{{ url('landscape-create/' . $oContinent->id) }}">
                        {{ trans('realm.add_landscape') }}
                    </a>
                </div>
            @endcan
        </div>
        <div class="panel-body">
            @include('widgets.landscapes', ['oLandscapes' => Auth::user()->knownLandscape($oContinent)])
        </div>
    </div>
@endsection