@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('ocean.name') }}</div>
        <span>
            <a href="{{ url('ocean/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" href="#island">
                    <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                    <span>{{ trans('island.assigned') }}</span>
                </a>
            </span>

            @can('create', new \App\Models\Island())
                <div class="pull-right">
                    <a href="{{ url('island/create/sea/' . $oObject->url) }}">
                        {{ trans('island.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div id="island" class="panel-body collapse">
            @include('widget.defaultList', ['aObjects' => \App\Models\Sea::islands($oObject), 'sTarget' => 'island'])
        </div>
    </div>
@endsection