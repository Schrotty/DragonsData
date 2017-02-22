@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('landscape.landscape') }}</div>
        <span>
            <a href="{{ url($oObject->parent->getModel() . '/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('tags')
    <div class="realm-player">
        <div>{{ trans('general.tags') }}</div>
        @include('widget.tags', ['oObject' => $oObject])
    </div>
@endsection