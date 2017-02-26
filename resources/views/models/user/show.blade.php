@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ URL::to('/img') }}/{{ strtolower($oObject->avatar) }}"
                         class="default-avatar big-avatar">
                </div>

                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-genral-data">
                                <div>{{ trans('user.username') }}</div>
                                <span>
                                    @if($oObject->forename == null & $oObject->surname == null)
                                        -
                                    @else
                                        {{ $oObject->forename }} {{ $oObject->surname }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
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
                        {{ $oObject->description }}
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
                {{ trans('user.no_assigned_realms_for_user', ['user' => $oObject->name]) }}
            @endif
        </div>
    </div>
@endsection