@extends('layouts.restricted_create')

@section('restricted')
    {{ Form::model($oObject, array('route' => array($oObject->getModel() . '.update', $oObject->url), 'method' => 'PUT')) }}
    @if(count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <span class="sr-only">Error:</span>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <input value="{{ $oObject->name }}" id="name" type="text" class="form-control" name="name" autofocus>
                </div>

                <div class="col-md-6">
                    <div class="pull-right">
                        <a href="{{ url($oObject->getModel() . '/' . $oObject->url) }}">
                            {{ trans('general.abort') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="object-description">
                        <div>{{ trans('general.description') }}</div>
                        <textarea id="name" type="text" class="form-control edit-block default-edit-block" name="description"
                                  autofocus>{!!trim(html_entity_decode($oObject->description))!!}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="object-description-short">
                        <div>{{ trans('general.description-short') }}</div>
                        <textarea id="name" type="text" class="form-control edit-block small-edit-block"
                                  name="short-description">{!!trim(html_entity_decode($oObject->shortDescription))!!}</textarea>
                    </div>
                </div>

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
        {{ Form::close() }}

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">{{ trans('general.save') }}</button>
                </div>

                <div class="col-md-2">
                    {{ Form::open(array('url' => $oObject->getModel() . '/' . $oObject->url)) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete Realm', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection