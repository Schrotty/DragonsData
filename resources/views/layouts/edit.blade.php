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

                    <div class="col-md-4">
                        @yield('left-block')
                    </div>

                    <div class="col-md-4">
                        @yield('middle-block')
                    </div>

                    <div class="col-md-4">
                        @yield('right-block')
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection