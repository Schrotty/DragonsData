@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="item-filter" action="{{ url('/item/') }}">
                <div class="form-group">
                    <div class="input-group search-group">
                        <input id="item-search-query" name="q" type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">

                        <span class="input-group-btn">
                            <button id="item-search-btn" class="btn btn-secondary" type="submit">
                                <span class="oi oi-magnifying-glass"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>

        @include('model.item.list')
    </div>
@endsection