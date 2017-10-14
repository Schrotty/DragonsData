@extends('layout.app')

@section('content')
    <form action="{{ '/category/' . $category->id }}" method="POST">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    <span>Edit Category</span>
                </h2>

                <div class="form-group">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label for="name">Name</label>
                    <input id="name" value="{{ $category->name }}" type="text" class="form-control @if($errors->has('name')) error @endif" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Edit Category</button>
            </div>
        </div>
    </form>
@endsection