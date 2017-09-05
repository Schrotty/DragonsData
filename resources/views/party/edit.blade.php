@extends('layout.app')

@section('content')

    <!-- Container -->
    <div class="panel panel-default">

        <!-- Heading -->
        <div class="panel-heading">
            <span class="panel-title">Edit Party</span>
        </div>

        <!-- Content -->
        <form action="{{ '/party/' . $party->_id }}" method="POST">
            <div class="panel-body">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ $party->name }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Members -->
                    <div class="col-md-4">
                        <label for="member">Members</label>
                        <select name="member[]" multiple class="selectpicker show-tick" data-live-search="true">
                            @foreach(\App\User::all() as $user)
                                @if(in_array($user->_id, (array)$party->member))
                                    <option selected value="{{ $user->_id }}">{{ $user->username }}</option>
                                    @continue
                                @endif

                                <option value="{{ $user->_id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Player -->
                    <div class="col-md-4">
                        <label for="member">Player</label>
                        <select id="member" name="player[]" multiple class="selectpicker show-tick" data-live-search="true">
                            @include('module.item.party.player-pre-select')
                        </select>
                    </div>

                    <!-- Chronist -->
                    <div class="col-md-4">
                        <label for="chronist">Chronist</label>
                        <select name="chronist" class="selectpicker show-tick" data-live-search="true">
                            @foreach(\App\User::all() as $user)
                                @if($user->_id == $party->chronist)
                                    <option selected value="{{ $user->_id }}">{{ $user->username }}</option>
                                    @continue
                                @endif

                                <option value="{{ $user->_id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#party-delete">
                            Delete Party
                        </button>
                    </div>

                    <div class="col-md-6 text-right">
                        @include('module.back-button')

                        <button type="submit" class="btn btn-primary">
                            Update Party
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="party-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="text-right" action="{{ '/party/'.$party->_id }}" method="POST">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Party?</h5>
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