@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>{{trans('realm.realm')}}</span>
        </div>

        <div class="panel-body">
            @include('widget.index', ['sModel' => 'realm'])
        </div>
    </div>
@endsection
