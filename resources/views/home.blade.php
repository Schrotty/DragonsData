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
                            <a href="{{ url('realm-create/') }}">
                                {{ trans('realm.create_realm') }}
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="panel-body">
                    @if( count(Auth::user()->knownRealms()) != 0 )
                        <table class="realm-table">
                            <tr>
                                <th>{{ trans('general.name') }}</th>
                                <th>{{ trans('general.description') }}</th>
                            </tr>

                            @foreach(Auth::user()->knownRealms() as $oRealm)
                                @if(!$oRealm->isOpen)
                                    <tr>
                                        <td><a href="{{ '/realm/' . $oRealm->id }}">{{ $oRealm->name }}</a></td>
                                        <td>{{ $oRealm->shortDescription }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    @else
                        {{ trans('user.no_assigned_realms') }}
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>{{trans('realm.open_realms')}}</span>
                    @can('isDungeonMaster', Auth::user())
                        <div class="pull-right">
                            <a href="{{ url('realm-create/1/') }}">
                                {{ trans('realm.create_open_realm') }}
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="panel-body">
                    @include('widgets.openRealms', ['realms' => \App\Models\Realm::all()->where('isOpen', true)])
                </div>
            </div>
        </div>

        @include('sidebar')
    </div>
</div>
@endsection
