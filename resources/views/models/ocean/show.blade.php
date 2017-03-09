@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.name') }}</div>
        <span>
            <a href="{{ url('realm/' . $oObject->realm->url) }}">{{ $oObject->realm->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" href="#sea">
                    <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                    <span>{{ trans('sea.assigned') }}</span>
                </a>
            </span>

            @can('create', new \App\Models\Sea())
                <div class="pull-right">
                    <a href="{{ url('sea/create/ocean/' . $oObject->url) }}">
                        {{ trans('sea.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div id="sea" class="panel-body collapse">
            @include('widget.defaultList', ['aObjects' => \App\Models\Ocean::seas($oObject), 'sTarget' => 'sea'])
        </div>
    </div>
@endsection