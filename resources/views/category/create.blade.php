@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Create Category</span>
        </div>

        <div class="panel-body">
            <form action="/category" method="POST">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection