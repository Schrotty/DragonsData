@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans_choice('user.users', 2) }}</div>
                    <div class="panel-body">
                        @include('widgets.realms')
                    </div>
                </div>
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection