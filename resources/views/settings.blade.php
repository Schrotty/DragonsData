@extends('layout.app')

@section('content')
    <form action="{{ '/settings/' . $settings->_id }}" method="POST">
        <div class="panel panel-default side-panel">
            <div class="panel-heading">
                <span class="panel-title">Application Settings</span>
            </div>

            <div class="panel-body">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="player-ident">Player Identifier</label>
                            <select id="player-ident" name="player-identifier" class="selectpicker">
                                @foreach(\App\Category::all() as $category)
                                    <option {{ \App\Settings::playerIdent() == $category->_id ? 'selected' : '' }} value="{{ $category->getValue('_id') }}">{{ $category->getValue('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- PROTECTED CATS/TAGS/PROPS -->
                <div class="row">

                    <!-- PROTECTED CATEGORIES -->
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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

    @if(\Illuminate\Support\Facades\Auth::user()->isRoot())
        @include('maintenance.maintenance')
    @endif
@endsection