@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-5 ml-md-auto">
            <form class="form-horizontal" method="POST" action="login">
                {{ method_field('POST') }}
                {{ csrf_field() }}

                <div class="card">
                    <div class="card-body">
                        <h2>
                            <span>Sign in</span>
                        </h2>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            <span>Sign in</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="ml-md-auto"></div>
    </div>
@endsection