@extends('layout.app')

@section('content')
    <form action="{{ '/search' }}">
        <div class="row search-box">
            <div class="col-md-8 ml-md-auto">
                <h2 class="text-normal">Search more than <strong>{{ \App\Item::all()->count() }}</strong> items</h2>
                <div class="input-group search-group">
                    <input name="q" type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
                    <div class="input-group-btn">
                        <button class="btn btn-secondary" type="submit">
                            <span class="oi oi-magnifying-glass"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Keep last col empty -->
            <div class="ml-auto"></div>
        </div>
    </form>
@endsection