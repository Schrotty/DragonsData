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
            <span>{{ trans('realm.assigned_landscapes') }}</span>
            @if($oObject->realm->isDungeonMaster(Auth::user()))
                <div class="pull-right">
                    <a href="{{ url('landscape/creator/' . $oObject->url) }}">
                        {{ trans('realm.add_landscape') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="panel-body">
            @include('widget.defaultList', ['aObjects' => \App\Models\Landscape::all(), 'sTarget' => 'landscape'])
        </div>
    </div>
@endsection