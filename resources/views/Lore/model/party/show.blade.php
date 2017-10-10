@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2>
                        <span>{{ $party->getValue('name') }}</span>
                    </h2>

                    <div class="row">
                        <div class="col item-content">

                            <!-- DATA PANEL -->
                            <div class="float-right container-data-wrapper">
                                <table class="table table-bordered">
                                    <tbody>

                                    <!-- USER INFO -->
                                    <tr>
                                        <th colspan="2">Member</th>
                                    </tr>

                                    <tr>
                                        <td>User</td>
                                        <td>
                                            @if($party->hasMember())
                                                @foreach($party->member as $member)
                                                    <span>{{ $member->username }}</span><br>
                                                @endforeach
                                            @else None @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Chronist</td>
                                        <td>
                                            @if($party->hasChronist())
                                                <span>{{ $party->chronist->username }}</span><br>
                                            @else None @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Character</td>
                                        <td>
                                            @if($party->hasCharacters())
                                                @foreach($party->characters as $character)
                                                    <a href="{{ url('/item/' . $character->id) }}"><span>{{ $character->name }}</span></a><br>
                                                @endforeach
                                            @else None @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- CONTENT -->
                            <div class="container-data-content">
                                {!! $party->toMarkdown('description') !!}

                                @if(count($party->entries) > 0)
                                    @include('model.party.journal.index', ['index' => $party->entries])
                                @endif

                                @foreach($party->entries as $entry)
                                    <h3 id="{{ strtolower($entry->getValue('title')) }}">
                                        {{ $entry->getValue('title') }}

                                        @can('update', $entry)
                                            <span class="float-right" style="font-size: small">
                                            <a href="{{ '/entry/'.$entry->id.'/edit' }}">
                                                <span>edit</span>
                                            </a>
                                        </span>
                                        @endcan
                                    </h3>

                                    {!! '<p><i>'.$entry->getValue('date').'</i> - '.substr($entry->toMarkdown('content'), 3) !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                @can('writeDown', $party)
                    <div class="card-footer text-right">
                        <a href="{{ '/entry/create/' . $party->id }}"><button class="btn btn-primary">Add Journal Entry</button></a>

                        @can('update', $party)
                            <a href="{{ '/party/' . $party->id . '/edit' }}">
                                <button type="submit" class="btn btn-primary">Edit Party</button>
                            </a>
                        @endcan
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection