@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans_choice('user.users', 2) }}
                </div>
                <div class="panel-body">
                    <table class="user-table">
                        <tr>
                            <th>{{ trans('general.name') }}</th>
                            <th>{{ trans('user.rank') }}</th>
                        </tr>

                        @foreach($users as $user)
                            <tr>
                                <td><a href="{{ url('user/' . $user->id) }}">{{$user->name}}</a></td>
                                <td>{{ $user->rank->name }}</td>
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