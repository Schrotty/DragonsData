@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $user->name }}

                        @if(Auth::user()->id == $user->id)
                            <!-- user edit profile -->
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ URL::to('/img') }}/{{ strtolower($user->avatar) }}" class="default-avatar big-avatar">
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="profile-genral-data">
                                            <div>Name: </div>
                                            <span>
                                                @if($user->forename == null & $user->surname == null)
                                                    -
                                                @else
                                                    {{ $user->forename }} {{ $user->surname }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="profile-contact-data">
                                            <div>Mail: </div>
                                            <span>
                                                @if($user->mail == null)
                                                    -
                                                @else
                                                    {{ $user->mail }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-realms">
                                    <div>Assigned Realms</div>
                                    @if(count($user->realms) == 0) - @endif
                                    @foreach($user->realms as $realm)
                                        <a href="{{ '/realm/' . $realm->id }}">{{ $realm->name }}</a>

                                        @if( !$loop->last )
                                            ,
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Description
                    </div>

                    <div class="panel-body">
                        {{ $user->description }}
                    </div>
                </div>
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection