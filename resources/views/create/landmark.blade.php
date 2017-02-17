@extends('layouts.create')

@section('left-block')
    <div class="col-md-4">
        <div class="realm-gamemaster">
            <div>{{ trans('realm.landscape') }}</div>
            <span>
                @include('widgets.elements.landscapes_with_access', ['landscape' => new \App\Models\Landscape(), 'preset' => $param])
            </span>
        </div>
    </div>
@endsection

@section('middle-block')
    <div class="col-md-4">
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widgets.elements.user_dropdown_multi', ['obj' => new \App\Models\Landmark()])
        </div>
    </div>
@endsection

@section('right-block')
    <div class="col-md-4">
        <div class="realm-player">
            <div>{{ trans('general.tags') }}</div>
            @include('widgets.elements.tags', ['obj' => new \App\Models\Landmark()])
        </div>
    </div>
@endsection