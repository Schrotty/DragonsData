@extends('layouts.restricted_create')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/continent-save') }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => new \App\Models\Continent(), 'sType' => 'continent', 'preset' => $iRealmID])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => new \App\Models\Continent()])
                    <div class="col-md-6">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.realm') }}</div>
                            <span>
                                @include('widgets.elements.realms_with_access', ['realm' => new \App\Models\Realm(), 'preset' => $iRealmID])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => new \App\Models\Continent()])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection