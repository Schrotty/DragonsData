@extends('layouts.restricted_edit')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/realm/save/' . $oObject->url) }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => $oObject, 'sType' => 'realm', 'preset' => $oObject->id])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => $oObject])

                    <div class="col-md-4">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.dungeon_master') }}</div>
                            <span>
                                @include('widgets.dropdown', ['oParent' => $oObject->parent, 'aObjects' => $oObject->possibleParents(['User'])])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => $oObject])
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="open-realm">
                            <div name="is-open" class="checkbox pull-left">
                                <label>
                                    @if($oObject->isOpen)
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