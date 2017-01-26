@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('user.users')}}
                </div>
                <div class="panel-body">
                    <table class="user-table">
                        <tr>
                            <th>Username</th>
                            <th>Rank</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Delete</th>
                        </tr>

                        @foreach($users as $user)
                            <tr>
                                <td><a href="{{ url('user/' . $user->id) }}">{{$user->name}}</a></td>
                                <td>
                                    @if($user->isAdmin)
                                        Admin
                                    @else
                                        Member
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d.m.Y') }}</td>
                                <td>{{ $user->updated_at->format('d.m.Y') }}</td>
                                <td><a href="{{ url('/user/' . $user->id . '/delete') }}">Delete User</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        @include('sidebar')
    </div>
</div>
@endsection