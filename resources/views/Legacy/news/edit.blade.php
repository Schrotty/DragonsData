@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Edit News</span>
        </div>

        <form action="{{ '/news/' . $news->_id }}" method="POST">
            <div class="panel-body">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" aria-describedby="titleHelp" placeholder="Enter Title" value="{{$news->title}}">
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" class="content form-control" name="content" rows="3">{{$news->content}}</textarea>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            Delete News
                        </button>
                    </div>

                    <div class="col-md-6 text-right">
                        @include('module.back-button')
                        <button type="submit" class="btn btn-primary">Update News</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="text-right" action="{{ '/news/'.$news->_id }}" method="POST">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete News?</h5>
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