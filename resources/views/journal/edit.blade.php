@extends('layout.app')

@section('content')

    <!-- Container -->
    <div class="panel panel-default">

        <!-- Heading -->
        <div class="panel-heading">
            <span class="panel-title">Edit Journal</span>
        </div>

        <!-- Content -->
        <form action="{{ '/journal/' . $journal->_id }}" method="POST">
            <div class="panel-body">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mce">Description</label>
                            <textarea id="mce" class="form-control" name="content" rows="3">{{ $journal->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        @include('module.back-button')
                        <button type="submit" class="btn btn-primary">
                            Update Journal
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection