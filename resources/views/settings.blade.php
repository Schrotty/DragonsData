@extends('layout.app')

@section('content')
    <form action="{{ '/settings/' . $settings->_id }}" method="POST">
        <div class="panel panel-default side-panel">
            <div class="panel-heading">
                <span class="panel-title">Maintenance IP Whitelist</span>
            </div>

            <div class="panel-body">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        @include('whitelist.index', ['entries' => \App\Settings::maintenanceWhitelist()])
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-primary" href="{{ '/whitelist/create' }}">Add Entry</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default side-panel">
            <div class="panel-heading">
                <span class="panel-title">Settings</span>
            </div>

            <div class="panel-body">

                <!-- PC TAG AND PROTECTED CATS/TAGS/PROPS -->
                <div class="row">

                    <!-- PLAYER TAG -->
                    <div class="col-md-3">
                        <label for="pctag">Player Tag</label>
                        <select name="pctag" id="pctag" class="selectpicker">
                            @foreach(\App\Tag::all() as $value)
                                @if(\App\Settings::playerTag() == $value->_id)
                                    <option selected value="{{ $value->_id }}">{{ $value->name }}</option>
                                    @continue
                                @endif

                                <option value="{{ $value->_id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- PROTECTED CATEGORIES -->
                    <div class="col-md-3">
                        <label for="cats">Protected categories</label>
                        <select name="categories[]" id="cats" class="selectpicker show-tick" multiple>
                            @foreach(\App\Category::all() as $value)
                                @if($value->protected)
                                    <option selected value="{{ $value->_id }}">{{ $value->name }}</option>
                                    @continue
                                @endif

                                <option value="{{ $value->_id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- PROTECTED TAGS -->
                    <div class="col-md-3">
                        <label for="tags">Protected tags</label>
                        <select name="tags[]" id="tags" class="selectpicker show-tick" multiple>
                            @foreach(\App\Tag::all() as $value)
                                @if($value->protected)
                                    <option selected value="{{ $value->_id }}">{{ $value->name }}</option>
                                    @continue
                                @endif

                                <option value="{{ $value->_id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- PROTECTED PROPERTIES -->
                    <div class="col-md-3">
                        <label for="props">Protected properties</label>
                        <select name="properties[]" id="props" class="selectpicker show-tick" multiple>
                            @foreach(\App\Property::all() as $value)
                                @if($value->protected)
                                    <option selected value="{{ $value->_id }}">{{ $value->name }}</option>
                                    @continue
                                @endif

                                <option value="{{ $value->_id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Apply Settings</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection