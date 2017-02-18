@extends('layouts.create')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.dungeon_master') }}</div>
            <span>
                @include('widgets.dropdown', ['oParent' => $oObject->parent, 'aObjects' => $oObject->possibleParents(['User'])])
            </span>
        </div>
@endsection

@section('middle-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widgets.elements.user_dropdown_multi', ['obj' => new \App\Models\Realm()])
        </div>
@endsection

@section('right-block')
        <div class="open-realm">
            <div name="is-open" class="checkbox pull-left">
                <label>
                    @if($sParameter == "true")
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