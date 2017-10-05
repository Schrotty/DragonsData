@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class='card dash dash-upper box'>
                <div class='content'>
                    <div class="card-body">
                        <h3>
                            <a href="{{ url('/admin/items') }}">Items</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class='card dash dash-upper box'>
                <div class='content'>
                    <div class="card-body">
                        <h3>Parties</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100"></div>

        <div class="col-md-6">
            <div class='card dash dash-lower box'>
                <div class='content'>
                    <div class="card-body">
                        <h3>
                            <a href="{{ url('/admin/meta') }}">Meta</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class='card dash dash-lower box'>
                <div class='content'>
                    <div class="card-body">
                        <h3>Blog</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection