@extends('layouts.restricted_create')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/realm-save') }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => new \App\Models\Realm(), 'sType' => null])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => new \App\Models\Realm()])
                    <div class="col-md-4">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.dungeon_master') }}</div>
                            <span>
                                @include('widgets.elements.user_dropdown', ['user' => Auth::user()])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => new \App\Models\Realm()])
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="open-realm">
                            <div name="is-open" class="checkbox pull-left">
                                <label>
                                    @if($open)
                                        <input checked name="is-open" type="checkbox" value="false">
                                    @else
                                        <input name="is-open" type="checkbox" value="false">
                                    @endif

                                    <span class="cr">
                                        <i class="cr-icon glyphicon glyphicon-ok"></i>
                                    </span>

                                    {{ trans('realm.is_open_realm') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection