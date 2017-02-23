@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('ocean.ocean') }}</div>
        <span>
            <a href="{{ url('ocean/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('island.assigned') }}</span>
            @can('create', new \App\Models\Island())
                <div class="pull-right">
                    <a href="{{ url('island/create/sea/' . $oObject->url) }}">
                        {{ trans('island.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Sea::islands($oObject), 'sTarget' => 'island'])
        </div>
    </div>
@endsection