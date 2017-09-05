@extends('layout.app')

@section('content')

    <!-- Container -->
    <div class="panel panel-default">

        <!-- Heading -->
        <div class="panel-heading">
            <span class="panel-title">Create Party</span>
        </div>

        <!-- Content -->
        <form action="/party" method="POST">
            <div class="panel-body">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Members -->
                    <div class="col-md-4">
                        <label for="member">Members</label>
                        <select name="member[]" multiple class="selectpicker show-tick" data-live-search="true">
                            @foreach(\App\User::all() as $user)
                                <option value="{{ $user->_id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Player -->
                    <div class="col-md-4">
                        <label for="member">Player</label>
                        <select id="member" name="player[]" multiple class="selectpicker show-tick" data-live-search="true">
                            @include('module.item.player-select')
                        </select>
                    </div>

                    <!-- Chronist -->
                    <div class="col-md-4">
                        <label for="chronist">Chronist</label>
                        <select name="chronist" class="selectpicker show-tick" data-live-search="true">
                            @foreach(\App\User::all() as $user)
                                <option value="{{ $user->_id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="panel-footer text-right">
                <button type="submit" class="btn btn-primary">
                    Create Party
                </button>
            </div>
        </form>
    </div>
@endsection