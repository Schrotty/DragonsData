@extends('layout.app')

@section('content')

    <!-- Container -->
    <div class="card">

        <!-- Content -->
        <form action="{{ '/party' }}" method="POST">
            <div class="card-body">
                <h2>
                    <span>Create Party</span>
                </h2>

                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control @if($errors->has('name')) error @endif" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                        <!-- Members -->
                        <div class="col-md-4">
                            <label for="member">Members</label>
                            <select id="member" name="member[]" multiple class="selectpicker show-tick @if($errors->has('member')) error @endif" data-live-search="true">
                                @include('model._utils.options', ['objects' => \App\User::all(), 'key' => 'username'])
                            </select>
                        </div>

                        <!-- Player -->
                        <div class="col-md-4">
                            <label for="character">Player</label>
                            <select id="character" name="character[]" multiple class="selectpicker show-tick @if($errors->has('character')) error @endif" data-live-search="true">
                                @include('model._utils.options', ['objects' => \App\Item::all(), 'key' => 'name'])
                            </select>
                        </div>

                        <!-- Chronist -->
                        <div class="col-md-4">
                            <label for="chronist">Chronist</label>
                            <select id="chronist" name="chronist" class="selectpicker show-tick @if($errors->has('chronist')) error @endif" data-live-search="true">
                                @include('model._utils.options', ['objects' => \App\User::all(), 'key' => 'username'])
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="mce">Description</label>
                    <textarea name="description" class="@if($errors->has('description')) error @endif" id="mce">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        @include('layout._util.back')
                        <button type="submit" class="btn btn-primary">
                            Create Party
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection