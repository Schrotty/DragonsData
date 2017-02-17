@extends('layouts.view')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.landscape') }}</div>
        <span>
            <a href="{{ url('landscape/' . $oObject->landscape->url) }}">{{ $oObject->landscape->name }}</a>
        </span>
    </div>
@endsection