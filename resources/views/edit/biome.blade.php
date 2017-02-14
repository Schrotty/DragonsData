@extends('layouts.restricted_edit')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST"
          action="{{ url('/biome-save/' . $oBiome->id) }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => $oBiome, 'sType' => 'biome', 'preset' => $oBiome->id])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => $oBiome])
                    <div class="col-md-4">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.landscape') }}</div>
                            <span>
                                @include('widgets.elements.landscapes_with_access', ['landscape' => $oBiome->landscape])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => $oBiome])
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="realm-player">
                            <div>{{ trans('general.tags') }}</div>
                            @include('widgets.elements.tags', ['obj' => $oBiome])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection