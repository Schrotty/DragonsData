@extends('layouts.create')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.continent') }}</div>
            <span>
                {{ App('debugbar')->info($oObject->parent()) }}
                @include('widget.dropdown', ['oParent' => $oObject->parent, 'aObjects' => $oObject->possibleParents(['Continent', 'Island'])])
            </span>
        </div>
@endsection

@section('right-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widget.elements.user_dropdown_multi', ['obj' => new \App\Models\Landscape()])
        </div>
@endsection