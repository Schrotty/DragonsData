@extends('layout.app')

@section('content')
    <form action="/whitelist" method="POST">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">Create Whitelist Entry</span>
            </div>

            <div class="panel-body">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-6">
                        <label for="ip">IP</label>
                        <input id="ip" name="ip" class="form-control" type="text" placeholder="IP">
                    </div>

                    <div class="col-md-6">
                        <label for="desc">Description</label>
                        <input id="desc" name="description" class="form-control" type="text" placeholder="Description">
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        @include('module.back-button')
                        <button type="submit" class="btn btn-primary">Create Entry</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection