@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @if($realm->isPrivate)
                    @include('realm.private')
                @elseif(count($realm->hasUser(Auth::user())) == 0)
                    @include('realm.enter')
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $realm->name }}</div>
                        <div class="panel-body">
                            {{ $realm->description }}
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Player</div>
                        <div class="panel-body">
                            <table class="user-table">
                                <tr>
                                    <th>Name</th>
                                    <th>Character</th>
                                    <th>Class</th>
                                    <th>Level</th>
                                </tr>

                                @foreach($realm->users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection