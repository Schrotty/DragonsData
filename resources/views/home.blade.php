@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('realm.realms')}}</div>
                <div class="panel-body">
                    @if( count($realms) != 0 )
                        <table class="realm-table">
                            <tr>
                                <th>{{ trans('general.name') }}</th>
                                <th>{{ trans('general.description') }}</th>
                            </tr>

                            @foreach($realms as $realm)
                                <tr>
                                    <td><a href="{{ '/realm/' . $realm->id }}">{{ $realm->name }}</a></td>
                                    <td>{{ $realm->shortDescription }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        {{ trans('user.no_assigned_realms') }}
                    @endif
                </div>
            </div>

            <!-- Open realms for everybody -->
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('realm.open_realms')}}</div>
                <div class="panel-body">
                    @include('widgets.openRealms', ['realms' => \App\Realm::all()])
                </div>
            </div>
        </div>

        @include('sidebar')
    </div>
</div>
@endsection
