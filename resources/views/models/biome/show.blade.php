@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('biome.name') }}</div>
        <span>
            <a href="{{ url($oObject->parent->getModel() . '/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('tags')
    <div class="realm-player">
        <div>{{ trans('general.tags') }}</div>
        @include('widget.tags', ['obj' => $oObject])
    </div>
@endsection