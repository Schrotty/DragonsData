@extends('layouts.view')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.realm') }}</div>
        <span>
            <a href="{{ url('realm/' . $oObject->realm->url) }}">{{ $oObject->realm->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('realm.assigned_landscapes') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('landscape/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_landscape') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widgets.defaultList', ['aObjects' => Auth::user()->knownLandscape($oObject), 'sTarget' => 'landscape'])
        </div>
    </div>
@endsection