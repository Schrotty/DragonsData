@extends('layouts.restricted_edit')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/lake-save/' . $oLake->id) }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => $oLake, 'sType' => 'lake'])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => $oLake])
                    <div class="col-md-6">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.landscape') }}</div>
                            <span>
                                @include('widgets.elements.landscapes_with_access', ['landscape' => $oLake->landscape])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => $oLake])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection