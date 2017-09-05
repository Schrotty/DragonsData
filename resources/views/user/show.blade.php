@extends('layout.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">Characters</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Parties</th>
                </tr>
                </thead>
                <tbody>
                @if(count($user->characters()) > 0)
                    @foreach($user->characters() as $character)
                        <tr>
                            <td><a href="/item/{{ $character->_id }}">{{ $character->name }}</a></td>
                            <td>
                                @foreach(\App\Party::partiesWhereMember($character) as $party)
                                    <a href="{{ '/party/'.$party->_id }}">{{ $party->name }}</a>@if(!$loop->last),@endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Parties</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Member</th>
                </tr>
                </thead>
                <tbody>
                @if(count($user->parties()) > 0)
                    @foreach($user->parties() as $party)
                        <tr>
                            <td><a href="/party/{{ $party->_id }}">{{ $party->name }}</a></td>
                            <td>{{ count($party->member) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">Known Items</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover table-responsive data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($user->accessible()) > 0)
                    @foreach($user->accessible() as $item)
                        <tr>
                            <td><a href="/item/{{ $item->_id }}">{{ $item->name }}</a></td>
                            <td>{{ \App\Category::find($item->category)->name }}</td>
                            <td>{!! substr($item->description, 0, 50) !!}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection