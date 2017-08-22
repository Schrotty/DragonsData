@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-body">
            {{ $exception->getMessage() }}
        </div>
    </div>
@endsection