@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Create Property</span>
        </div>

        <div class="panel-body">
            <form action="/property" method="POST">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="title">Category</label>
                    <select name="category" class="selectpicker" data-live-search="true">
                        @foreach(\App\Category::all() as $category)
                            <option value="{{ $category->_id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Create Property</button>
                </div>
            </form>
        </div>
    </div>
@endsection