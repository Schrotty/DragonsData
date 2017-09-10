@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Create Category</span>
        </div>

        <form action="/category" method="POST">
            <div class="panel-body">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection