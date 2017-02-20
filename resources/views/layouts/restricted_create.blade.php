@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @can('create',$oObject)
                    @yield('restricted')
                @else
                    @include('widget.noAccess')
                @endcan
            </div>

            @include('sidebar')
        </div>
    </div>
@endsection