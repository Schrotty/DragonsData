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
            <span>{{ trans('realm.assigned_seas') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('sea/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_sea') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => Auth::user()->knownSeas($oObject), 'sTarget' => 'sea'])
        </div>
    </div>
@endsection