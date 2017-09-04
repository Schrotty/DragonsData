@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Create User</span>
        </div>

        <form action="/user" method="POST">
            <div class="panel-body">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Username</label>
                            <input type="text" class="form-control" name="username" aria-describedby="titleHelp" placeholder="Username">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="char">Character</label>
                        <select id="char" name="char" class="selectpicker" data-live-search="true">
                            @foreach(\App\Item::byTag(\App\Settings::playerTag()) as $item)
                                <option value="{{ $item->_id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="group">Group</label>
                            <select class="selectpicker form-control" id="group" name="group" style="height: inherit">
                                <option value="{{ \App\Groups::ROOT }}">{{ \App\Groups::NAMES[\App\Groups::ROOT] }}</option>
                                <option value="{{ \App\Groups::ADMIN }}">{{ \App\Groups::NAMES[\App\Groups::ADMIN] }}</option>
                                <option value="{{ \App\Groups::MEMBER }}" selected>{{ \App\Groups::NAMES[\App\Groups::MEMBER] }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="title">Password</label>
                        <div class="row">
                            <div class="col-md-6">

                                <input type="text" class="form-control" name="password" aria-describedby="titleHelp" placeholder="Password">
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="password_confirmation" aria-describedby="titleHelp" placeholder="Password confirm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        @include('module.back-button')
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection