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
                <div class="form-group">
                    <label for="title">Username</label>
                    <input value="{{ $user->username }}" type="text" class="form-control" name="username" aria-describedby="titleHelp" placeholder="Username">
                </div>

                <div class="form-group">
                    <label for="group">Group</label>
                    <select class="form-control" id="group" name="group" style="height: inherit">
                        @if($user->group == \App\Groups::ROOT)
                            <option selected value="{{ \App\Groups::ROOT }}">{{ \App\Groups::NAMES[\App\Groups::ROOT] }}</option>
                        @else
                            <option value="{{ \App\Groups::ROOT }}">{{ \App\Groups::NAMES[\App\Groups::ROOT] }}</option>
                        @endif

                        @if($user->group == \App\Groups::ADMIN)
                            <option selected value="{{ \App\Groups::ADMIN }}">{{ \App\Groups::NAMES[\App\Groups::ADMIN] }}</option>
                        @else
                            <option value="{{ \App\Groups::ADMIN }}">{{ \App\Groups::NAMES[\App\Groups::ADMIN] }}</option>
                        @endif

                        @if($user->group == \App\Groups::MEMBER)
                            <option selected value="{{ \App\Groups::MEMBER }}">{{ \App\Groups::NAMES[\App\Groups::MEMBER] }}</option>
                        @else
                            <option value="{{ \App\Groups::MEMBER }}">{{ \App\Groups::NAMES[\App\Groups::MEMBER] }}</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            Delete User
                        </button>
                    </div>

                    <div class="col-md-6">
                        <div class="text-right">
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