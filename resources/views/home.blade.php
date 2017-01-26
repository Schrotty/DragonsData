@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('dashboard.realms')}}</div>
                <div class="panel-body">
                    @if( count($realms) != 0 )
                        <table class="realm-table">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Player</th>
                                <th>Gamemaster</th>
                            </tr>

                            @foreach($realms as $realm)
                                <tr>
                                    <td><a href="{{ '/realm/' . $realm->id }}">{{ $realm->name }}</a></td>
                                    <td>{{ $realm->shortDescription }}</td>
                                    <td>{{ count($realm->users) }}</td>
                                    <td><a href="{{ '/user/' . $realm->gamemaster->id }}">{{ $realm->gamemaster->name }}</a></td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        {{ trans('dashboard.no_realms_found') }}
                    @endif
                </div>
            </div>
        </div>

        @include('sidebar')
    </div>
</div>
@endsection
