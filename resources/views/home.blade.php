@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>{{trans('realm.realms')}}</span>
                    @can('isDungeonMaster', Auth::user())
                        <div class="pull-right">
                            <a href="{{ url('realm/creator/false') }}">
                                {{ trans('realm.create_realm') }}
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="panel-body">
                    @include('widgets.realms', ['realms' => Auth::user()->knownRealms(), 'openRealmMode' => false])
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>{{trans('realm.open_realms')}}</span>
                    @if(Auth::user()->isDungeonMaster)
                        <div class="pull-right">
                            <a href="{{ url('realm/creator/true') }}">
                                {{ trans('realm.create_open_realm') }}
                            </a>
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    @include('widgets.realms', ['realms' => \App\Models\Realm::all()->where('isOpen', true), 'openRealmMode' => true])
                </div>
            </div>
        </div>

        @include('sidebar')
    </div>
</div>
@endsection
