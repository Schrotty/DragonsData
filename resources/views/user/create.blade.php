@extends('layout.app')

@section('content')
    @can('create', App\News::class)
        <div class="panel panel-default side-panel">
            <div class="panel-heading">
                <span class="panel-title">Create User</span>
            </div>

            <div class="panel-body">
                <form action="/user" method="POST">
                    {{ method_field('POST') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="title">Usernae</label>
                        <input type="text" class="form-control" name="username" aria-describedby="titleHelp" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <label for="group">Group</label>
                        <select class="form-control" id="group" name="group" style="height: inherit">
                            <option value="{{ \App\Groups::ROOT }}">{{ \App\Groups::NAMES[\App\Groups::ROOT] }}</option>
                            <option value="{{ \App\Groups::ADMIN }}">{{ \App\Groups::NAMES[\App\Groups::ADMIN] }}</option>
                            <option value="{{ \App\Groups::MEMBER }}" selected>{{ \App\Groups::NAMES[\App\Groups::MEMBER] }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Password</label>
                        <input type="text" class="form-control" name="password" aria-describedby="titleHelp" placeholder="Password">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection