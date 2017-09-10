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

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="known">Known</label>
                            <select id="known" name="known[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    <option>{{ $user->getValue('username') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="known">Known</label>
                            <select id="known" name="known[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    <option>{{ $user->getValue('username') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="parties">Party</label>
                            <select id="parties" name="parties[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\Party::all() as $party)
                                    <option>{{ $party->getValue('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row row-double">
                    <div class="col">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="parties[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\Party::all() as $party)
                                    <option>{{ $party->getValue('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select id="tags" name="parties[]" multiple class="selectpicker" data-live-search="true">
                                @foreach(\App\Party::all() as $party)
                                    <option>{{ $party->getValue('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="references">References</label>
                            <select id="references" name="parents[]" multiple class="selectpicker show-tick" data-live-search="true">
                                @foreach(\App\Item::all() as $item)
                                    <option value="{{ $item->_id }}">{{ $item->name }}</option>
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
                            <div class="col">
                                <input class="form-control" placeholder="Property">
                            </div>

                            <div class="col">
                                <input class="form-control" placeholder="Property">
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