@extends('layouts.create')

@section('left-block')
    <div class="realm-gamemaster">
        <div>{{ trans('sea.sea') }}</div>
        <span>
                @if(isset($oParent))
                @include('widget.dropdown', ['sName'  => 'ocean', 'oParent' => $oParent, 'aObjects' => \App\Models\Ocean::all()])
            @else
                @include('widget.dropdown', ['sName'  => 'ocean', 'oParent' => $oObject->parent, 'aObjects' => \App\Models\Ocean::all()])
            @endif
            </span>
    </div>
@endsection

@section('middle-block')
    <div class="realm-player">
        <div>{{ trans('general.known_by') }}</div>
        @include('widget.elements.user_dropdown_multi', ['obj' => new \App\Models\Sea()])
    </div>
@endsection