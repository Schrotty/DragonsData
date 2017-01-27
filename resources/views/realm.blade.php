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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="realm-description">
                                        <div>{{ trans('general.description') }}</div>
                                        <span>{{ $realm->description }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="realm-gamemaster">
                                        <div>{{ trans('realms.gamemaster') }}</div>
                                        <span>{{ $realm->gamemaster->name }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="realm-player">
                                        <div>{{ trans('general.player_count') }}</div>
                                        <span>{{ count($realm->users) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('general.player') }}</div>
                        <div class="panel-body">
                            <table class="user-table">
                                <tr>
                                    <th>{{ trans('general.name') }}</th>
                                    <th>{{ trans('general.character') }}</th>
                                    <th>{{ trans('general.class') }}</th>
                                    <th>{{ trans('general.level') }}</th>
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