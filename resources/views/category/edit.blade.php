@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Edit Category</span>
        </div>

        <form action="{{ '/category/' . $category->_id }}" method="POST">
            {{ method_field('PUT') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="panel-body">
                <div class="form-group">
                    <label for="title">Name</label>
                    <input value="{{ $category->name }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button @if($category->protected) disabled @endif type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            Delete Category
                        </button>
                    </div>

                    <div class="col-md-6">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="text-right" action="{{ '/category/'.$category->_id }}" method="POST">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Category?</h5>
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