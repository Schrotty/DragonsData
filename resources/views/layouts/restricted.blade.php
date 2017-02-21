@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (Session::has('message'))
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        {{ Session::get('message') }}
                    </div>
                @endif

                @can('view', $oObject)
                    @yield('restricted')
                @else
                    @include('widget.noAccess')
                @endcan
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection