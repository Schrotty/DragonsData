@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{trans('general.search')}}</span>
        </div>

        <div class="panel-body">
            @include('widget.index')
        </div>
    </div>
@endsection