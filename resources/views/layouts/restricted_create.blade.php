@extends('layouts.app')

@section('content')
    @can('create',$oObject)
        @yield('restricted')
    @else
        @include('widget.noAccess')
    @endcan
@endsection