@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    @if($oObject->avatar != null)
                    <img src="{{ URL::to('/img') }}/{{ strtolower($oObject->avatar) }}"
                         class="default-avatar big-avatar">
                    @else
                        <img src="{{ URL::to('/img') }}/default.png"
                             class="default-avatar big-avatar">
                    @endif
                </div>

                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-contact-data">
                                <div>{{ trans('user.username') }}</div>
                                <span>{{ $oObject->name }}</span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="profile-genral-data">
                                <div>{{ trans('user.name') }}</div>
                                <span>
                                    @if($oObject->forename == null & $oObject->surname == null)
                                        -
                                    @else
                                        {{ $oObject->forename }} {{ $oObject->surname }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="profile-contact-data">
                                <div>{{ trans('general.mail') }}</div>
                                <span>
                                    @if($oObject->mail == null)
                                        -
                                    @else
                                        {{ $oObject->mail }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="profile-description">
                        <div>{{ trans('general.description') }}</div>
                        @if($oObject->description == null)
                            -
                        @else
                            {{ $oObject->mail }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('realm.assigned') }}
        </div>

        <div class="panel-body">
            @if( count($oObject->knownRealms()) > 0 )
                @include('widget.realms', ['realms' => $oObject->knownRealms(), 'openRealmMode' => false])
            @else
                {{ trans('user.no_assigned_realms') }}
            @endif
        </div>
    </div>
@endsection