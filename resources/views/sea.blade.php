@extends('layouts.view')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.ocean') }}</div>
        <span>
            <a href="{{ url('ocean/' . $oObject->ocean->url) }}">{{ $oObject->ocean->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{ trans('realm.assigned_islands') }}</span>
            @can('edit', $oObject)
                <div class="pull-right">
                    <a href="{{ url('island/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_island') }}
                    </a>
                </div>
            @endcan
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => Auth::user()->knownIslands($oObject), 'sTarget' => 'island'])
        </div>
    </div>
@endsection