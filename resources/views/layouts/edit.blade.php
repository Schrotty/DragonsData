@extends('layouts.restricted_edit')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/' . $sModel . '/save/' . $oObject->url) }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => $oObject])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => $oObject])

                    @yield('left-block')
                    @yield('middle-block')
                    @yield('right-block')
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection