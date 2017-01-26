@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('user.users')}}</div>
                    <div class="panel-body">
                        <table class="user-table">
                            <tr>
                                <th>Name</th>
                                <th>Creator</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                            @foreach($realms as $realm)
                                <tr>
                                    <td><a href="{{ url('realm/' . $realm->id) }}">{{ $realm->name }}</a></td>
                                    <td><a href="{{ url('user/' . $realm->creator->id) }}">{{ $realm->creator->name }}</a></td>
                                    <td>{{ $realm->created_at->format('d.m.Y') }}</td>
                                    <td>{{ $realm->updated_at->format('d.m.Y') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Actions
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-default">Create new realm</button>
                        <button type="button" class="btn btn-default">Delete existing realm</button>
                    </div>
                </div>
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection