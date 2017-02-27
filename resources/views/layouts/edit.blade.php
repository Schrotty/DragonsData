@extends('layouts.restricted_create')

@section('restricted')
    {{ Form::model($oObject, array('route' => array($oObject->getModel() . '.update', $oObject->url), 'method' => 'PUT', 'id' => 'update-form')) }}
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

        <div class="panel-footer">
            <button class="btn btn-primary" type="submit">
                {{ trans($oObject->getModel() . '.save') }}
            </button>

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal">
                {{ trans($oObject->getModel() . '.delete') }}
            </button>
        </div>
    </div>
    {{ Form::close() }}

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog">
        {{ Form::open(array('id' => 'delete-form', 'url' => $oObject->getModel() . '/' . $oObject->url)) }}
        {{ Form::hidden('_method', 'DELETE') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Object?</h4>
                </div>

                <div class="modal-body">
                    Do you want to delete?!
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('general.abort') }}</button>


                    {{ Form::submit(trans('general.delete'), array('class' => 'btn btn-danger')) }}
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection