@extends('layouts.restricted_create')

@section('restricted')
    {{ Form::open(array('url' => $oObject->getModel())) }}
    @if(count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <span class="sr-only">Error:</span>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <span class="panel-title">User Creation</span>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a href="{{ url('/') }}">
                            {{ trans('general.abort') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <span>Username:</span>
                    <input class="form-control" name="name" title="name">
                </div>

                <div class="col-md-6">
                    <span>Forename:</span>
                    <input class="form-control" name="forename" title="forename">
                </div>

                <div class="col-md-6">
                    <span>Surname:</span>
                    <input class="form-control" name="surname" title="surname">
                </div>

                <div class="col-md-12">
                    <span>Email:</span>
                    <input class="form-control" name="mail" title="email">
                </div>

                <div class="col-md-6">
                    <span>Password:</span>
                    <input class="form-control" name="password" title="password">
                </div>

                <div class="col-md-6">
                    <span>Password:</span>
                    <input class="form-control" name="password_confirmation" title="password-confirmation">
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <button class="btn btn-primary" type="submit">{{ trans('general.create') }}</button>
        </div>
    </div>
    {{ Form::close() }}
@endsection