@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- ITEMS -->
            <div class='card mb-3'>
                <div class='content'>
                    <div class="card-body text-center">
                        <h4 class="card-title">Items</h4>
                        <div>
                            <span><a href="{{ url('/admin/items') }}">Manage</a> | </span>
                            <span><a href="{{ url('/item/create') }}">Create</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PARTIES -->
            <div class='card mb-3'>
                <div class='content'>
                    <div class="card-body text-center">
                        <h4 class="card-title">Parties</h4>
                        <div>
                            <span><a href="{{ url('/admin/parties') }}">Manage</a> | </span>
                            <span><a href="{{ url('/party/create') }}">Create</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CATEGORY -->
            <div class='card mb-3'>
                <div class='content'>
                    <div class="card-body text-center">
                        <h4 class="card-title">Categories</h4>
                        <div>
                            <span><a href="{{ url('/admin/categories') }}">Manage</a> | </span>
                            <span><a href="{{ url('/category/create') }}">Create</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAGS -->
            <div class='card mb-3'>
                <div class='content'>
                    <div class="card-body text-center">
                        <h4 class="card-title">Tags</h4>
                        <div>
                            <span><a href="{{ url('/admin/tags') }}">Manage</a> | </span>
                            <span><a href="{{ url('/tag/create') }}">Create</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PROPERTIES -->
            <div class='card'>
                <div class='content'>
                    <div class="card-body text-center">
                        <h4 class="card-title">Property</h4>
                        <div>
                            <span><a href="{{ url('/admin/properties') }}">Manage</a> | </span>
                            <span><a href="{{ url('/property/create') }}">Create</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">System Settings</h4>
                    <div class="row">
                        <div class="col">
                            <label for="player-id">Player Category</label>
                            <select id="player-id" class="selectpicker">
                                <option>None</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection