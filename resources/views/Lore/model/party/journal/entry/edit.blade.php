@extends('layout.app')

@section('content')

    <!-- Container -->
    <div class="card">
        <form action="{{ '/entry/'.$entry->id }}" method="POST">
            <div class="card-body">
                <!-- Heading -->
                <h2>
                    <span class="panel-title">Edit Journal Entry</span>
                </h2>

                <!-- Content -->
                <div class="panel-body">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="title">Title</label>
                                <input id="title" class="form-control @if($errors->has('title')) error @endif" name="title" value="{{ $entry->title }}">
                            </div>

                            <div class="col-6">
                                <label for="date">Date</label>
                                <input id="date" class="form-control @if($errors->has('date')) error @endif" name="date" value="{{ $entry->date }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="mce">Content</label>
                                <textarea id="mce" class="@if($errors->has('content')) error @endif" name="content">{{ $entry->content }}</textarea>
                            </div>
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
                            Update Entry
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection