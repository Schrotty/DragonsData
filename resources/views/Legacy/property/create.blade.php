@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Create Property</span>
        </div>

        <form action="/property" method="POST">
            <div class="panel-body">
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
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Create Property</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection