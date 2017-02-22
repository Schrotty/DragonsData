@extends('layouts.edit')

@section('left-block')
    <div class="realm-gamemaster">
        <div>{{ trans('realm.dungeon_master') }}</div>
        <span>
            @include('widget.dropdown', ['sName' => 'parent', 'aObjects' => [\App\Models\Island::all(), \App\Models\Continent::all()]])
        </span>
    </div>
@endsection

@section('middle-block')
    <div class="realm-player">
        <div>{{ trans('general.known_by') }}</div>
        @include('widget.elements.user_dropdown_multi', ['obj' => $oObject])
    </div>
@endsection