@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.realm') }}</div>
        <span>
            {{ App('debugbar')->info($oObject) }}
            <a href="{{ url('continent/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection