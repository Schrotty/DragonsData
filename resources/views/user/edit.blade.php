@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Edit User</span>
        </div>

        <form action="{{ '/user/' . $user->_id }}" method="POST">
            {{ method_field('PUT') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Username</label>
                            <input value="{{ $user->username }}" type="text" class="form-control" name="username" aria-describedby="titleHelp" placeholder="Username">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="char">Character</label>
                        <select id="char" name="char" class="selectpicker" data-live-search="true">
                            @foreach(\App\Item::byTag(\App\Settings::playerTag()) as $item)
                                @if(in_array($item->_id, (array)$user->chars))
                                    <option selected value="{{ $item->_id }}">{{ $item->name }}</option>
                                    @continue
                                @endif

                                <option value="{{ $item->_id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="group">Group</label>
                        <select class="selectpicker" class="form-control" id="group" name="group">
                            @foreach(\App\Auth::all() as $auth)
                                @if($user->group == $auth->level)
                                    <option selected value="{{ $auth->level }}">{{ $auth->name }}</option>
                                    @continue
                                @endif

                                <option value="{{ $auth->level }}">{{ $auth->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            Delete User
                        </button>

                        <a href="{{ '/password-reset/'.$user->_id }}" class="btn btn-danger">Reset Password</a>
                    </div>

                    <div class="col-md-6">
                        <div class="text-right">
                            @include('module.back-button')
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="text-right" action="{{ '/user/'.$user->_id }}" method="POST">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User?</h5>
                    </div>

                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-secondary btn-block" data-dismiss="modal">Abort</button>
                        </div>

                        <div class="col-md-6">
                            <div class="text-right">
                                <button type="submit" class="btn btn-danger btn-block">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection