@extends('layouts.app')

@section('content')
    @can('edit', $oObject)
        @yield('restricted')
    @else
        @include('widget.noAccess')
    @endcan
@endsection