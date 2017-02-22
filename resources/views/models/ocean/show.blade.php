@extends('layouts.show')

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
            <span>{{ trans('sea.assigned_seas') }}</span>
            @can('create', new \App\Models\Sea())
                <div class="pull-right">
                    <a href="{{ url('sea/create/ocean/' . $oObject->url) }}">
                        {{ trans('sea.add_sea') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Ocean::seas($oObject), 'sTarget' => 'sea'])
        </div>
    </div>
@endsection