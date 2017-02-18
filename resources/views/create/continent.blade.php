@extends('layouts.create')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.realm') }}</div>
            <span>
                @include('widgets.dropdown', ['oParent' => $oObject->parent, 'aObjects' => $oObject->possibleParents(['Realm'])])
            </span>
        </div>
@endsection

@section('right-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widgets.elements.user_dropdown_multi', ['obj' => new \App\Models\Continent()])
        </div>
@endsection