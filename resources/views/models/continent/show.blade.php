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
            <span>{{ trans('landscape.assigned') }}</span>
            @can('create', new \App\Models\Landscape())
                <div class="pull-right">
                    <a href="{{ url('landscape/create/continent/' . $oObject->url) }}">
                        {{ trans('landscape.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Continent::landscapes($oObject), 'sTarget' => 'landscape'])
        </div>
    </div>
@endsection