@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oObject->name }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url($sModel . '/editor/' . $oObject->url) }}">
                        {{ trans('realm.edit_' . $sModel) }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widgets.description', ['oObject' => $oObject])

                <div class="col-md-6">
                    @yield('parent')
                </div>

                <div class="col-md-6">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widgets.knownBy', ['object' => $oObject])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('child-elements')
@endsection