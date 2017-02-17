@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @can('create', \Illuminate\Support\Facades\Auth::user())
                    @yield('restricted')
                @else
                    @include('widgets.noAccess')
                @endcan
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection