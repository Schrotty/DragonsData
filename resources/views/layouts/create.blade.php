@extends('layouts.restricted_create')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/' . $sModel . '/create') }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => new \App\Models\Realm()])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => new \App\Models\Realm()])

                    @yield('left-block')
                    @yield('middle-block')
                    @yield('right-block')
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection