@extends('layouts.restricted')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/realm/' . $realm->id . '/save') }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>{{ $realm->name }}</span>

                <div class="pull-right">
                    <a href="{{ url('realm/' . $realm->id) }}">
                        {{ trans('general.abort') }}
                    </a>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="realm-description">
                            <div>{{ trans('general.description') }}</div>
                            <textarea id="name" type="text" class="form-control edit-block" name="description" required
                                      autofocus>{!!trim(html_entity_decode($realm->description))!!}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.dungeon_master') }}</div>
                            <span>
                                @include('widgets.elements.user_dropdown', ['user' => $realm->gamemaster])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => $realm])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('general.actions') }}</div>
            <div class="panel-body">
                <button class="btn btn-default" type="submit">{{ trans('general.save') }}</button>
            </div>
        </div>
    </form>
@endsection