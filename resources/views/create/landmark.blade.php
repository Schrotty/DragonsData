@extends('layouts.create')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.landscape') }}</div>
            <span>
                @include('widget.dropdown', ['oParent' => $oObject->parent, 'aObjects' => $oObject->possibleParents(['Landscape'])])
            </span>
        </div>
@endsection

@section('middle-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widget.elements.user_dropdown_multi', ['obj' => new \App\Models\Landmark()])
        </div>
@endsection

@section('right-block')
        <div class="realm-player">
            <div>{{ trans('general.tags') }}</div>
            @include('widget.elements.tags', ['obj' => new \App\Models\Landmark()])
        </div>
@endsection