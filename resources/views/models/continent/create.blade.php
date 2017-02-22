@extends('layouts.create')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.realm') }}</div>
            <span>
                @if(isset($oParent))
                    @include('widget.dropdown', ['sName'  => 'realm', 'oParent' => $oParent, 'aObjects' => [\App\Models\Realm::all()]])
                @else
                    @include('widget.dropdown', ['sName'  => 'realm', 'oParent' => $oObject->parent, 'aObjects' => [\App\Models\Realm::all()]])
                @endif
            </span>
        </div>
@endsection

@section('middle-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widget.elements.user_dropdown_multi', ['obj' => new \App\Models\Continent()])
        </div>
@endsection