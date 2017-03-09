@extends('layouts.edit')

@section('left-block')
    <div class="realm-gamemaster">
        <div>{{ trans('landscape.name') }}</div>
        <span>
            @include('widget.dropdown', ['sName' => 'landscape', 'aObjects' => [\App\Models\Landscape::all()]])
        </span>
    </div>
@endsection

@section('middle-block')
    <div class="realm-player">
        <div>{{ trans('general.known_by') }}</div>
        @include('widget.elements.user_dropdown_multi', ['obj' => $oObject])
    </div>
@endsection

@section('right-block')
    <div class="realm-player">
        <div>{{ trans('general.tags') }}</div>
        @include('widget.elements.tags', ['obj' => $oObject])
    </div>
@endsection