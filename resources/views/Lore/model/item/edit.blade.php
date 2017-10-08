@extends('layout.app')

@section('content')
    <form action="{{ url('/item/'.$container->id) }}" method="POST">
        <div class="card">
            <div class="card-body">
                <h2>
                    <span>Edit Item</span>
                </h2>

                <div class="form-group">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label for="title">Name</label>
                    <input id="title" value="{{ $item->name }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Title">
                </div>

                <div class="spacer"></div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="known">Known</label>
                            <select id="known" name="readAccess[]" multiple class="selectpicker" data-live-search="true">
                                    @foreach(\App\User::all() as $user)
                                        @if($item->hasUserWithReadAccess())
                                            @if($user->hasReadAccess($item))
                                                <option selected value="{{ $user->id }}">{{ $user->username }}</option>
                                                @continue
                                            @endif
                                        @endif

                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contributors">Contributors</label>
                            <select id="contributors" name="writeAccess[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    @if($item->hasUserWithWriteAccess())
                                        @if($user->hasWriteAccess($item))
                                                <option selected value="{{ $user->id }}">{{ $user->username }}</option>
                                                @continue
                                            @endif
                                        @endif

                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parties">Parties</label>
                            <select id="parties" name="parties[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\Party::all() as $party)
                                    @if($item->hasParties())
                                        @if($item->hasParty($party))
                                            <option selected value="{{ $party->id }}">{{ $party->name }}</option>
                                            @continue
                                        @endif
                                    @endif

                                    <option value="{{ $party->id }}">{{ $party->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row row-double">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="selectpicker">
                                @foreach(\App\Category::all() as $category)
                                    @if($item->category->id == $category->id)
                                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select id="tags" name="tags[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\Tag::all()->groupBy('category_id') as $group)
                                    <optgroup label="{{ $group[0]->category->name }}">
                                        @foreach($group as $tag)
                                            @if($item->hasTag($tag))
                                                <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @continue
                                            @endif

                                            <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="references">References</label>
                            <select id="references" name="references[]" multiple class="selectpicker show-tick" data-live-search="true">
                                @foreach(\App\Item::all() as $ref)
                                    @if($item->hasReference($ref))
                                        <option selected value="{{ $ref->id }}">{{ $ref->name }}</option>
                                        @continue
                                    @endif

                                    <option value="{{ $ref->id }}">{{ $ref->name }}</option>
                                @endforeach
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
                                                        @foreach(\App\Property::all()->where('category', $category->id) as $property)
                                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
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
                                                        @foreach(\App\Property::all()->where('category', $category->id) as $property)
                                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
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
                            <input value="{{ $item->getValue('teaser') }}" id="teaser" class="form-control" name="teaser" placeholder="Teaser">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description">{{ $item->getValue('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                @include('layout._util.back')
                <button type="submit" class="btn btn-primary">Update Item</button>
            </div>
        </div>
    </form>
@endsection