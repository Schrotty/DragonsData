@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Edit Item</span>
        </div>

        <form action="{{ '/item/' . $item->_id }}" method="POST">
            <div class="panel-body">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">Name</label>
                    <input value="{{ $item->name }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Title">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="content">Known</label>
                            <select name="known[]" multiple class="selectpicker show-tick" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    @if($user->_id != $item->author)
                                        @if($item->known != null)
                                            @foreach($item->known as $known)
                                                @if($known == $user->_id)
                                                    <option selected value="{{ $user->_id }}">{{ $user->username }}</option>
                                                @else
                                                    <option value="{{ $user->_id }}">{{ $user->username }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{ $user->_id }}">{{ $user->username }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="content">Contributors</label>
                            <select name="contributors[]" multiple class="selectpicker show-tick" data-live-search="true">
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

                        <div class="col-md-3">
                            <label for="content">Category</label>
                            <select name="category" class="selectpicker" data-live-search="true">
                                @foreach(\App\Category::all() as $category)
                                    @if($item->category == $category->_id)
                                        <option selected value="{{ $category->_id }}">{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->_id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="content">Tags</label>
                            <select name="tags[]" multiple class="selectpicker" data-live-search="true">
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

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="content">Parents</label>
                            <select name="parents[]" multiple class="selectpicker show-tick" data-live-search="true">
                                @foreach(\App\Item::all() as $itm)
                                    @if($item->_id != $itm->_id)
                                        @if($item->parents != null)
                                            @foreach($item->parents as $parent)
                                                @if($parent == $itm->_id)
                                                    <option selected value="{{ $itm->_id }}">{{ $itm->name }}</option>
                                                @else
                                                    <option value="{{ $itm->_id }}">{{ $itm->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{ $itm->_id }}">{{ $itm->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Properties</label>

                    @php $i = 0 @endphp
                    @if($item->properties != null)
                        @foreach($item->properties as $key => $prop)
                            @if($i % 2 == 0)
                                <div class="row">
                                    @endif

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <select name="key[]" class="selectpicker" multiple data-max-options="1" data-live-search="true">
                                                    @foreach(\App\Category::all() as $category)
                                                        <optgroup label="{{ $category->name }}">
                                                            @foreach(\App\Property::all()->where('category', $category->_id) as $property)
                                                                @if($key == $property->_id)
                                                                    <option selected value="{{ $property->_id }}">{{ $property->name }}</option>
                                                                @else
                                                                    <option value="{{ $property->_id }}">{{ $property->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input value="{{ $prop }}" placeholder="Value" name="value[]" type="text" class="form-control" aria-label="Text input with dropdown button">
                                        </div>
                                    </div>

                                    @if($i % 2 != 0 || $loop->last)
                                        @if($loop->last && $i % 2 == 0)
                                            @php $i++ @endphp
                                            @include('module.properties')
                                        @endif

                                </div>
                            @endif
                            @php $i++ @endphp
                        @endforeach
                    @endif

                    @for($n = 0;$n < 10 - $i; $n++)
                        @if($n % 2 == 0)
                            <div class="row">
                        @endif
                        @include('module.properties')
                        @if($n % 2 != 0)
                            </div>
                        @endif
                    @endfor
                </div>

                <div class="form-group">
                    <label for="content">Description</label>
                    <textarea id="mce" class="form-control" name="content" rows="3">{{ $item->description }}</textarea>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        @can('delete', $item)
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                Delete Item
                            </button>
                        @endcan
                    </div>

                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary">Update Item</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="item-delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="text-right" action="{{ '/item/'.$item->_id }}" method="POST">
                {{ method_field('DELETE') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Item?</h5>
                    </div>

                    <div class="modal-footer">
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-secondary btn-block" data-dismiss="modal">Abort</button>
                        </div>

                        <div class="col-md-6">
                            <div class="text-right">
                                <button type="submit" class="btn btn-danger btn-block">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection