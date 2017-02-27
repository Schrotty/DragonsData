@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.dungeon_master') }}</div>
        <span>
            <a href="{{ url('user/' . $oObject->dungeonMaster->url) }}">{{ $oObject->dungeonMaster->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" href="#continent">
                    <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                    <span>{{ trans('continent.assigned') }}</span>
                </a>
            </span>

            @can('create', new \App\Models\Continent())
                <div class="pull-right">
                    <a href="{{ url('continent/create/realm/' . $oObject->url) }}">
                        {{ trans('continent.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div id="continent" class="panel-body collapse">
            @include('widget.defaultList', ['aObjects' => \App\Models\Realm::continents($oObject), 'sTarget' => 'continent'])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" href="#ocean">
                    <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                    <span>{{ trans('ocean.assigned') }}</span>
                </a>
            </span>

            @can('create', new \App\Models\Ocean())
                <div class="pull-right">
                    <a href="{{ url('ocean/create/realm/' . $oObject->url) }}">
                        {{ trans('ocean.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div id="ocean" class="panel-body collapse">
            @include('widget.defaultList', ['aObjects' => \App\Models\Realm::oceans($oObject), 'sTarget' => 'ocean'])
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" href="#empire">
                    <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                    <span>{{ trans('empire.assigned') }}</span>
                </a>
            </span>

            @can('create', new \App\Models\Ocean())
                <div class="pull-right">
                    <a href="{{ url('empire/create/realm/' . $oObject->url) }}">
                        {{ trans('empire.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div id="empire" class="panel-body collapse">
            @include('widget.defaultList', ['aObjects' => \App\Models\Realm::empires($oObject)])
        </div>
    </div>
@endsection