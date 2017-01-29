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
                                            <div>{{ trans('general.name_double_dot') }}</div>
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
                                            <div>{{ trans('general.mail_double_dot') }}</div>
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

                                <div class="profile-description">
                                    <div>{{ trans('general.description_double_dot') }}</div>
                                    {{ $user->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('user.assigned_realms') }}
                    </div>

                    <div class="panel-body">
                        @if( count($user->knownRealms) > 0 )
                            @include('widgets.realms', ['realms' => $user->knownRealms])
                        @else
                            {{ trans('user.no_assigned_realms_for_user', ['user' => $user->name]) }}
                        @endif
                    </div>
                </div>
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection