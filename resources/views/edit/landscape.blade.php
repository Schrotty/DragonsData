@extends('layouts.restricted')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/landscape-save/' . $oLandscape->id) }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => $oLandscape, 'sType' => 'landscape'])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => $oLandscape])
                    <div class="col-md-6">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.continent') }}</div>
                            <span>
                                @include('widgets.elements.continents_with_access', ['continent' => $oLandscape->continent])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => $oLandscape])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection