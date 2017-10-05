@extends('layout.app')

@section('content')
    <form action="{{ url('/item') }}" method="POST">
        <div class="card">
            <div class="card-body">
                <h2>
                    <span>Create Item</span>
                </h2>

                <div class="form-group">
                    {{ method_field('POST') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label for="title">Name</label>
                    <input id="title" value="{{ old('name') }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Title">
                </div>

                <div class="spacer"></div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="known">Known</label>
                            <select id="known" name="readAccess[]" multiple class="selectpicker" data-live-search="true">
                                @include('model._utils.options', ['objects' => \App\User::all(), 'key' => 'username'])
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contributors">Contributors</label>
                            <select id="contributors" name="writeAccess[]" multiple class="selectpicker" data-live-search="true">
                                @include('model._utils.options', ['objects' => \App\User::all(), 'key' => 'username'])
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parties">Parties</label>
                            <select id="parties" name="parties[]" multiple class="selectpicker" data-live-search="true">
                                @include('model._utils.options', ['objects' => \App\Party::all(), 'key' => 'name'])
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row row-double">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="selectpicker">
                                @include('model._utils.options', ['objects' => \App\Category::all(), 'key' => 'name'])
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select id="tags" name="tags[]" multiple class="selectpicker" data-live-search="true">
                                @include('model._utils.options', ['objects' => \App\Tag::all(), 'key' => 'name'])
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="references">References</label>
                            <select id="references" name="references[]" multiple class="selectpicker show-tick" data-live-search="true">
                                @include('model._utils.options', ['objects' => \App\Item::all(), 'key' => 'name'])
                            </select>
                        </div>
                    </div>
                </div>

                <div class="spacer"></div>

                <div class="form-group">
                    <label for="properties">Properties</label>
                    @for($i = 0; $i < 5; $i++)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <select name="key[]" class="selectpicker" multiple data-max-options="1" data-live-search="true">
                                                @foreach(\App\Category::all() as $category)
                                                    <optgroup label="{{ $category->name }}">
                                                        @foreach(\App\Property::all()->where('category', $category->_id) as $property)
                                                            <option value="{{ $property->_id }}">{{ $property->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>

                                        <input placeholder="Value" name="value[]" type="text" class="form-control" aria-label="Text input with dropdown button">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <select name="key[]" class="selectpicker" multiple data-max-options="1" data-live-search="true">
                                                @foreach(\App\Category::all() as $category)
                                                    <optgroup label="{{ $category->name }}">
                                                        @foreach(\App\Property::all()->where('category', $category->_id) as $property)
                                                            <option value="{{ $property->_id }}">{{ $property->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>

                                        <input placeholder="Value" name="value[]" type="text" class="form-control" aria-label="Text input with dropdown button">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="spacer"></div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="teaser">Teaser</label>
                            <input id="teaser" class="form-control" name="teaser" placeholder="Teaser">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Create Item</button>
            </div>
        </div>
    </form>
@endsection