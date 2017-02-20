@extends('layouts.edit')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.mountain') }}</div>
            <span>
                @include('widget.dropdown', ['oParent' => $oObject->parent, 'aObjects' => $oObject->possibleParents(['Landscape'])])
            </span>
        </div>
@endsection

@section('right-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widget.elements.user_dropdown_multi', ['obj' => $oObject])
        </div>
@endsection




