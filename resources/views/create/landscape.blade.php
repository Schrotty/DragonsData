@extends('layouts.create')

@section('left-block')
    <div class="col-md-4">
        <div class="realm-gamemaster">
            <div>{{ trans('realm.continent') }}</div>
            <span>
                @include('widgets.elements.continents_with_access')
            </span>
        </div>
    </div>
@endsection

@section('middle-block')
    <div class="col-md-4"></div>
@endsection

@section('right-block')
    <div class="col-md-4">
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widgets.elements.user_dropdown_multi', ['obj' => new \App\Models\Landscape()])
        </div>
    </div>
@endsection