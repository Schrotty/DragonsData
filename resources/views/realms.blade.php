@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('user.users')}}</div>
                    <div class="panel-body">
                        @include('widgets.realms')
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('general.actions') }}
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-default">{{ trans('realm.create_new_realm') }}</button>
                        <button type="button" class="btn btn-default">{{ trans('realm_delete_realm') }}</button>
                    </div>
                </div>
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection