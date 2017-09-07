@extends('layout.app')

@section('content')

    <!-- Containerr -->
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-12">
                    <h2>{{ $party->name }}</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

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
                                        @if($party->hasValues('member'))
                                            @foreach($party->member as $id)
                                                <span>{{ \App\User::byId($id)->getValue('username') }}</span><br>
                                            @endforeach
                                        @else None @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Chronist</td>
                                    <td>
                                        @if($party->hasValues('chronist'))
                                            <span>{{ \App\User::byId($party->chronist)->getValue('username') }}</span><br>
                                        @else None @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Character</td>
                                    <td>
                                        @if($party->hasValues('player'))
                                            @foreach($party->player as $id)
                                                <span>{{ \App\Item::byId($id)->getValue('name') }}</span><br>
                                            @endforeach
                                        @else None @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- CONTENT -->
                    <div class="container-data-content">
                        {!! $party->description !!}

                        @if(count($party->entries) > 0)
                            @include('module.party.journal.index', ['index' => $party->entries])
                        @endif

                        @foreach($party->entries as $entry)
                            <h3 id="{{ strtolower($entry->getValue('title')) }}">
                                {{ $entry->getValue('title') }}

                                <span class="float-right" style="font-size: small">
                                    <a href="{{ '/entry/'.$entry->_id.'/edit' }}">
                                        <span>edit</span>
                                    </a>
                                </span>
                            </h3>

                            {!! '<p><i>'.$entry->getValue('date').'</i> - '.substr($entry->getValue('content'), 3) !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @can('update', \App\Journal::find($party->journal))
            <div class="panel-footer text-right">
                <div class="row text-right">
                    <div class="col-md-12">
                        <a href="{{ '/entry/create/' . $party->_id }}">
                            <button class="btn btn-primary">
                                Add Journal Entry
                            </button>
                        </a>

                        @can('update', $party)
                            <a href="{{ '/party/' . $party->_id . '/edit' }}">
                                <button class="btn btn-primary">
                                    Edit Party
                                </button>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        @endcan
    </div>

    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
        @include('module.party.items')
    @endif
@endsection