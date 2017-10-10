@extends('layout.app')

@section('content')
    <!-- Container -->
    <div class="card">

        <!-- Content -->
        <form action="{{ '/party/' . $party->id }}" method="POST">
            <div class="card-body">
                <h2>
                    <span>Edit Party</span>
                </h2>

                {{ method_field('PUT') }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ $party->name }}" type="text" class="form-control" name="name" aria-describedby="titleHelp" placeholder="Enter Name">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                        <!-- Members -->
                        <div class="col-md-4">
                            <label for="member">Members</label>
                            <select id="member" name="member[]" multiple class="selectpicker show-tick" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    @if($user->isPartyMember($party))
                                        <option selected value="{{ $user->id }}">{{ $user->username }}</option>
                                        @continue
                                    @endif

                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Player -->
                        <div class="col-md-4">
                            <label for="character">Player</label>
                            <select id="character" name="character[]" multiple class="selectpicker show-tick" data-live-search="true">
                                <!-- === CHARACTERS === -->
                            </select>
                        </div>

                        <!-- Chronist -->
                        <div class="col-md-4">
                            <label for="chronist">Chronist</label>
                            <select id="chronist" name="chronist" class="selectpicker show-tick" data-live-search="true">
                                @foreach(\App\User::all() as $user)
                                    @if($user->isChronist($party))
                                        <option selected value="{{ $user->id }}">{{ $user->username }}</option>
                                        @continue
                                    @endif

                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="mce">Description</label>
                    <textarea name="description" id="mce">{{ $party->description }}</textarea>
                </div>

                <div class="form-group">
                    <label>Entries</label>
                    <table class="table table-hover table-responsive table-sm">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Content</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($party->hasEntries())
                                @foreach($party->entries as $entry)
                                    <tr>
                                        <td>{{ $entry->getValue('title') }}</td>
                                        <td>{{ $entry->getValue('date') }}</td>
                                        <td>{{ $entry->getTeaser() }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-sm btn-outline-primary" href="{{ url('/party/' . $party->id) . '#' . strtolower($entry->getValue('title')) }}">Show</a>
                                            <a class="btn btn-sm btn-outline-warning" href="{{ url('/entry/' . $entry->id) . '/edit' }}">Edit</a>
                                            <a id="{{ $entry->id }}" class="btn btn-sm btn-outline-danger" href="#" data-toggle="modal" data-target=".bd-example-modal-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        @include('layout._util.back')
                        <button type="submit" class="btn btn-primary">
                            Update Party
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div id="delete-entry-modal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="deleteItemModal" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Entry?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="delete-entry" class="text-right" action="{{ '/entry'}}" method="POST">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="modal-footer">
                            <button id="delete-item-btn" class="btn btn-danger" type="submit">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection