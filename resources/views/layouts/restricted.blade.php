@extends('layouts.app')

@section('content')
    @can('view', $oObject)
        @yield('restricted')
    @else
        @include('widget.noAccess')
    @endcan
@endsection