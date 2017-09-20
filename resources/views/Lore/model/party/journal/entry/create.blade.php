@extends('layout.app')

@section('content')

    <!-- Container -->
    <div class="card">

        <!-- Content -->
        <form action="{{ '/entry' }}" method="POST">
            <div class="card-body">

                <!-- Heading -->
                <h2 class="panel-heading">
                    <span class="panel-title">Create Journal Entry</span>
                </h2>

                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="party" value="{{ $party }}">

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="title">Title</label>
                            <input id="title" class="form-control" name="title">
                        </div>

                        <div class="col-6">
                            <label for="date">Date</label>
                            <input id="date" class="form-control" name="date">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label for="mce">Content</label>
                            <textarea id="mce" name="content"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        @include('layout._util.back')
                        <button type="submit" class="btn btn-primary">
                            Create Entry
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection