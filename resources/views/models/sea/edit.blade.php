@extends('layouts.edit')

@section('left-block')
    <div class="realm-gamemaster">
        <div>{{ trans('ocean.ocean') }}</div>
        <span>
            @include('widget.dropdown', ['sName' => 'ocean', 'aObjects' => [\App\Models\Ocean::all()]])
        </span>
    </div>
@endsection

@section('middle-block')
    <div class="realm-player">
        <div>{{ trans('general.known_by') }}</div>
        @include('widget.elements.user_dropdown_multi', ['obj' => $oObject])
    </div>
@endsection