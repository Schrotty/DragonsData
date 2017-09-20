@extends('layout.app')

@section('content')
    <form action="{{ url('/item/'.$container->getValue('_id')) }}" method="POST">
        <div class="card">
            <div class="card-body">
                <h2>
                    <span>Edit Item</span>
                </h2>

                <div class="form-group">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label for="title">Name</label>
                    <input id="title" value="{{ $item->getValue('name') }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Title">
                </div>

                <div class="spacer"></div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="known">Known</label>
                            <select id="known" name="known[]" multiple class="selectpicker" data-live-search="true">
                                <optgroup label="Single user">
                                    @foreach(\App\User::all() as $user)
                                        @if($user->_id != $item->author)
                                            @if($item->known != null)
                                                @if(in_array($user->_id, $item->known))
                                                    <option selected value="{{ $user->_id }}">{{ $user->username }}</option>
                                                    @continue
                                                @endif

                                                <option value="{{ $user->_id }}">{{ $user->username }}</option>
                                            @else
                                                <option value="{{ $user->_id }}">{{ $user->username }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Parties">
                                    @foreach(\App\Party::all() as $party)
                                        <option value="{{ $party->_id }}">{{ $party->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="contributors">Contributors</label>
                            <select id="contributors" name="contributors[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    @if($user->_id != $item->author)
                                        @if($item->contributors != null)
                                            @if(in_array($user->_id, $item->contributors))
                                                <option selected value="{{ $user->_id }}">{{ $user->username }}</option>
                                                @continue
                                            @endif

                                            <option value="{{ $user->_id }}">{{ $user->username }}</option>
                                        @else
                                            <option value="{{ $user->_id }}">{{ $user->username }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parties">Parties</label>
                            <select id="parties" name="parties[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\Party::all() as $party)
                                    @if($item->party != null)
                                        @if(in_array($party->_id, $item->party))
                                            <option selected value="{{ $party->_id }}">{{ $party->name }}</option>
                                            @continue
                                        @endif

                                        <option value="{{ $party->_id }}">{{ $party->name }}</option>
                                    @else
                                        <option value="{{ $party->_id }}">{{ $party->name }}</option>
                                    @endif
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
                                    @if($item->category()->getValue('_id') == $category->_id)
                                        <option selected value="{{ $category->_id }}">{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->_id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select id="tags" name="tags[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\Category::all() as $category)
                                    <optgroup label="{{ $category->name }}">
                                        @foreach(\App\Tag::all()->where('category', $category->_id) as $tag)
                                            @if($item->tags != null)
                                                @if(in_array($tag->_id, $item->tags))
                                                    <option selected value="{{ $tag->_id }}">{{ $tag->name }}</option>
                                                    @continue
                                                @endif

                                                <option value="{{ $tag->_id }}">{{ $tag->name }}</option>
                                            @else
                                                <option value="{{ $tag->_id }}">{{ $tag->name }}</option>
                                            @endif
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
                                @foreach(\App\Item::all() as $itm)
                                    @if($itm->_id != $item->_id)
                                        @if($item->parents != null)
                                            @if(in_array($itm->_id, $item->parents))
                                                <option selected value="{{ $itm->_id }}">{{ $itm->name }}</option>
                                                @continue
                                            @endif

                                            <option value="{{ $itm->_id }}">{{ $itm->name }}</option>
                                        @else
                                            <option value="{{ $itm->_id }}">{{ $itm->name }}</option>
                                        @endif
                                    @endif
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
                <button type="submit" class="btn btn-primary">Update Item</button>
            </div>
        </div>
    </form>
@endsection