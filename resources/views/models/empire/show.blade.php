@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('realm.name') }}</div>
        <span>
            <a href="{{ url('realm/' . $oObject->realm->url) }}">{{ $oObject->realm->name }}</a>
        </span>
    </div>
@endsection