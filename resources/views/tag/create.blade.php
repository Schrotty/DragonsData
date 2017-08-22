@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Create Tag</span>
        </div>

        <div class="panel-body">
            <form action="/tag" method="POST">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Category">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">Category</label>
                            <select name="category" class="selectpicker" data-live-search="true">
                                @foreach(\App\Category::all() as $category)
                                    <option value="{{ $category->_id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="title">Style</label>
                            <select name="style" class="selectpicker">
                                <option data-content="<span class='label badge-primary'>Primary</span>" value="primary"></option>
                                <option data-content="<span class='label badge-secondary'>Secondary</span>" value="secondary"></option>
                                <option data-content="<span class='label badge-success'>Success</span>" value="success"></option>
                                <option data-content="<span class='label badge-danger'>Danger</span>" value="danger"></option>
                                <option data-content="<span class='label badge-warning'>Warning</span>" value="warning"></option>
                                <option data-content="<span class='label badge-info'>Info</span>" value="info"></option>
                                <option data-content="<span class='label badge-dark'>Dark</span>" value="dark"></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Create Tag</button>
                </div>
            </form>
        </div>
    </div>
@endsection