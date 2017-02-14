@extends('layouts.restricted_edit')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/continent-save/' . $oContinent->id) }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => $oContinent, 'sType' => 'continent', 'preset' => $oContinent->id])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => $oContinent])
                    <div class="col-md-6">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.realm') }}</div>
                            <span>
                                @include('widgets.elements.realms_with_access', ['realm' => $oContinent->realm])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => $oContinent])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection