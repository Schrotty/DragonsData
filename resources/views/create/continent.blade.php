@extends('layouts.create')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.realm') }}</div>
            <span>
                @include('widget.dropdown', ['oParent' => $oParent, 'aObjects' => $oObject->possibleParents(['realm.realm'])])
            </span>
        </div>
@endsection

@section('right-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widget.elements.user_dropdown_multi', ['obj' => new \App\Models\Continent()])
        </div>
@endsection