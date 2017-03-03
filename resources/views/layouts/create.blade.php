@extends('layouts.restricted_create')

@section('restricted')
    {{ Form::open(array('url' => $oObject->getModel())) }}
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
                        <input value="{{ old('name') }}" id="name" type="text" class="form-control" name="name" autofocus>
                    </div>

                    <div class="col-md-6">
                        <div class="pull-right">
                            <a href="{{ url('/') }}">
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
                            <textarea id="description" id="name" type="text"
                                      class="form-control edit-block default-edit-block" name="description"
                                      autofocus>{!!trim(html_entity_decode(old('description')))!!}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="object-description-short">
                            <div>{{ trans('general.description-short') }}</div>
                            <textarea id="name" type="text" class="form-control edit-block small-edit-block"
                                      name="short-description">{!!trim(html_entity_decode(old('short-description')))!!}</textarea>
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
                <button class="btn btn-primary" type="submit">{{ trans('general.create') }}</button>
            </div>
        </div>
    {{ Form::close() }}
@endsection