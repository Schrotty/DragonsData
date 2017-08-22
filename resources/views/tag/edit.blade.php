@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Edit Tag</span>
        </div>

        <form action="{{ '/tag/' . $tag->_id }}" method="POST">
            {{ method_field('PUT') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="panel-body">
                <div class="form-group">
                    <label for="title">Name</label>
                    <input value="{{ $tag->name }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Category">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">Category</label>
                            <select name="category" class="selectpicker" data-live-search="true">
                                @foreach(\App\Category::all() as $category)
                                    @if($tag->category == $category->_id)
                                        <option selected value="{{ $category->_id }}">{{ $category->name }}</option>
                                        @continue
                                    @endif

                                    <option value="{{ $category->_id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="title">Style</label>
                            <select name="style" class="selectpicker">
                                @foreach(\App\TagStyle::STYLES as $style)
                                    @if($style == $tag->style)
                                        <option selected data-content="<span class='label badge-{{ $style }}'>{{ ucfirst($style) }}</span>" value="{{ $style }}"></option>
                                        @continue
                                    @endif

                                    <option data-content="<span class='label badge-{{ $style }}'>{{ ucfirst($style) }}</span>" value="{{ $style }}"></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                            Delete Tag
                        </button>
                    </div>

                    <div class="col-md-6">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update Tag</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="text-right" action="{{ '/tag/'.$tag->_id }}" method="POST">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Tag?</h5>
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