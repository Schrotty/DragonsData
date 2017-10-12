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

            <!-- META -->
            <div class='card'>
                <div class='content'>
                    <div class="card-body text-center">
                        <h4 class="card-title">Meta</h4>
                        <div>
                            <span><a href="{{ url('/admin/meta') }}">Manage</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">System Settings</h4>
                    <span>Soon!</span>
                </div>
            </div>
        </div>
    </div>
@endsection