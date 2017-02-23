@extends('layouts.edit')

@section('left-block')
    <div class="realm-gamemaster">
        <div>{{ trans('realm.dungeon_master') }}</div>
        <span>
            @include('widget.dropdown', ['sName' => 'dungeon-master', 'aObjects' => [\App\Models\User::userWithPrivilege('is_dungeon_master')]])
        </span>
    </div>
@endsection

@section('middle-block')
    <div class="realm-player">
        <div>{{ trans('general.known_by') }}</div>
        @include('widget.elements.user_dropdown_multi', ['obj' => $oObject])
    </div>
@endsection

@section('right-block')
    <div class="open-realm">
        <div name="is-open" class="checkbox pull-left">
            <label>
                @if($oObject->isOpen)
                    <input checked name="is-open" type="checkbox" value="true">
                @else
                    <input name="is-open" type="checkbox" value="false">
                @endif

                <span class="cr">
                        <i class="cr-icon glyphicon glyphicon-ok"></i>
                    </span>

                {{ trans('realm.is_open_realm') }}
            </label>
        </div>
    </div>
@endsection