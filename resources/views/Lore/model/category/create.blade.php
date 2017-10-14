@extends('layout.app')

@section('content')
    <form action="{{ url('/category') }}" method="POST">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    <span>Create Category</span>
                </h2>

                <div class="form-group">
                    {{ method_field('POST') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label for="name">Name</label>
                    <input id="name" value="{{ old('name') }}" type="text" class="form-control @if($errors->has('name')) error @endif" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Create Category</button>
            </div>
        </div>
    </form>
@endsection