@extends('layouts.restricted')

@section('restricted')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ $oObject->name }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url($oObject->getModel() . '/' . $oObject->url . '/edit/') }}">
                        {{ trans( $oObject->getModel() . '.edit', ['model' => $oObject->getModel()]) }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            <div class="row">
                @include('widget.description', ['oObject' => $oObject])

                <div class="col-md-4">
                    @yield('parent')
                </div>

                <div class="col-md-4">
                    <div class="realm-player">
                        <div>{{ trans('general.known_by') }}</div>
                        @include('widget.knownBy')
                    </div>
                </div>

                <div class="col-md-4">
                    @yield('tags')
                </div>
            </div>
        </div>
    </div>

    @yield('child-elements')
@endsection