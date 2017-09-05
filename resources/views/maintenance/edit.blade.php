@extends('layout.app')

@section('content')

    <!-- Container -->
    <div class="panel panel-default">

        <!-- Heading -->
        <div class="panel-heading">
            <span class="panel-title">Edit Message</span>
        </div>

        <!-- Content -->
        <form action="{{ '/maintenance' }}" method="POST">
            <div class="panel-body">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mce">Message</label>
                            <input id="mce" class="form-control" name="message" value="{{ $message }}">
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
                            Update Message
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection