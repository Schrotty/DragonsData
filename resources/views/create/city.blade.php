@extends('layouts.create')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.continent') }}</div>
            <span>
                @include('widgets.dropdown', ['oParent' => $oObject->parent, 'aObjects' => $oObject->possibleParents(['Landscape'])])
            </span>
        </div>
@endsection

@section('middle-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widgets.elements.user_dropdown_multi', ['obj' => new \App\Models\City()])
        </div>
@endsection

@section('right-block')
        <div class="realm-player">
            <div>{{ trans('general.tags') }}</div>
            @include('widgets.elements.tags', ['obj' => new \App\Models\City()])
        </div>
@endsection