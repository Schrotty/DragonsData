@extends('layout.app')

@section('content')
    <div class="row search-box">
        <div class="col-md-8 ml-md-auto">
            <h2 class="text-normal">Search more than <strong>{{ \App\Item::all()->count() }}</strong> items</h2>
            <div class="input-group search-group">
                <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">
                        <span class="oi oi-magnifying-glass"></span>
                    </button>
                </span>
            </div>
        </div>

        <!-- Keep last col empty -->
        <div class="ml-auto"></div>
    </div>
@endsection