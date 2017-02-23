@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span>{{trans('landscape.landscape')}}</span>
                    </div>

                    <div class="panel-body">
                        @include('widget.index', ['sModel' => 'lake'])
                    </div>
                </div>
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection
