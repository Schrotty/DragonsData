@extends('layout.app')

@section('content')
    <form id="item-filter" action="{{ url('/admin/parties/') }}">
        <div class="form-group">
            <div class="input-group search-group">
                <input value="@if(isset($q)){{ $q }}@endif" id="item-search-query" name="q" type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">

                <span class="input-group-btn">
                    <button id="item-search-btn" class="btn btn-secondary" type="submit">
                        <span class="oi oi-magnifying-glass"></span>
                    </button>
                </span>
            </div>
        </div>
    </form>

    @include('admin._util.table', [
        'route' => 'party',
        'header' => [
            'Name' => 'name'
        ]
    ])

    <div id="delete-item-modal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="deleteItemModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Item?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete-item" class="text-right" action="{{ '/item'}}" method="POST">
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-footer">
                        <button id="delete-item-btn" class="btn btn-danger" type="submit">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection