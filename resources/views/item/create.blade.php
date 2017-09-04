@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Create Item</span>
        </div>

        <form action="/item" method="POST">
            <div class="panel-body">
                {{ method_field('POST') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="title">Name</label>
                    <input value="{{ old('name') }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Title">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="content">Known</label>
                            <select name="known[]" multiple class="selectpicker show-tick" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    @if($user->_id != \Illuminate\Support\Facades\Auth::user()->_id)
                                        <option value="{{ $user->_id }}">{{ $user->username }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="content">Contributors</label>
                            <select name="contributors[]" multiple class="selectpicker show-tick" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    @if($user->_id != \Illuminate\Support\Facades\Auth::user()->_id)
                                        <option value="{{ $user->_id }}">{{ $user->username }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="content">Category</label>
                            <select name="category" class="selectpicker" data-live-search="true">
                                @foreach(\App\Category::all() as $category)
                                    <option value="{{ $category->_id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="content">Tags</label>
                            <select name="tags[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\Category::all() as $category)
                                    <optgroup label="{{ $category->name }}">
                                        @foreach(\App\Tag::all()->where('category', $category->_id) as $tag)
                                            <option value="{{ $tag->_id }}">{{ $tag->name }}</option>
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
                                @foreach(\App\Item::all() as $item)
                                    <option value="{{ $item->_id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Properties</label>
                    @for($i = 0; $i < 10; $i++)
                        @if($i % 2 == 0)
                            <div class="row">
                        @endif

                        @include('module.properties')

                        @if($i % 2 != 0)
                            </div>
                        @endif
                    @endfor
                </div>

                <div class="form-group">
                    <label for="content">Description</label>
                    <textarea id="mce" class="form-control" name="content" rows="3">{{ old('content') }}</textarea>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Create Item</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection