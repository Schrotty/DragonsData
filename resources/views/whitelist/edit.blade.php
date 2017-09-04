@extends('layout.app')

@section('content')
    <form action="{{ '/whitelist/' . $entry->_id }}" method="POST">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Create Whitelist Entry</span>
            </div>

            <div class="panel-body">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-6">
                        <label for="ip">IP</label>
                        <input value="{{ $entry->ip }}" id="ip" name="ip" class="form-control" type="text" placeholder="IP">
                    </div>

                    <div class="col-md-6">
                        <label for="desc">Description</label>
                        <input value="{{ $entry->description }}" id="desc" name="description" class="form-control" type="text" placeholder="Description">
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteIPEntry">
                            Delete Entry
                        </button>
                    </div>

                    <div class="col-md-6 text-right">
                        @include('module.back-button')
                        <button type="submit" class="btn btn-primary">Update Entry</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="deleteIPEntry" tabindex="-1" role="dialog" aria-labelledby="deleteIPEntry" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="text-right" action="{{ '/whitelist/'.$entry->_id }}" method="POST">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Entry?</h5>
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