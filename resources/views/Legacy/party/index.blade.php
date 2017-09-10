@extends('layout.app')

@section('content')

    <!-- Containerr -->
    <div class="panel panel-default">

        <!-- Heading -->
        <div class="panel-heading">
            <span class="panel-title">Parties</span>
        </div>

        <!-- Content -->
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Creator</th>
                        <th>Member</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($parties) > 0)
                        @foreach($parties as $party)
                            <tr>
                                <td>
                                    <a href="{{ '/party/' . $party->_id }}">{{ $party->name }}</a>
                                </td>
                                <td>{{ \App\User::find($party->creator)->username ?? 'Unknown' }}</td>
                                <td>{{ count($party->member) }}</td>
                                <td class="text-right non-link">
                                    <a href="{{ '/party/' . $party->_id . '/edit' }}">
                                        <button type="button" class="btn-empty">
                                            <span class="oi oi-pencil"></span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="panel-footer text-right">
            <a href="/party/create">
                <button class="btn btn-primary">
                    Add Party
                </button>
            </a>
        </div>
    </div>
@endsection