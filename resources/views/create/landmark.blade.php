@extends('layouts.restricted_create')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/landmark-save') }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => new \App\Models\Landmark(), 'sType' => 'landscape', 'preset' => $iLandscapeID])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => new \App\Models\Landmark()])
                    <div class="col-md-4">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.landscape') }}</div>
                            <span>
                                @include('widgets.elements.landscapes_with_access', ['landscape' => new \App\Models\Landscape(), 'preset' => $iLandscapeID])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => new \App\Models\Landmark()])
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <div>{{ trans('general.tags') }}</div>
                            @include('widgets.elements.tags', ['obj' => new \App\Models\Landmark()])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection