@extends('layout.app')

@section('content')
    <div class="panel panel-default side-panel">
        <div class="panel-heading">
            <span class="panel-title">User</span>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Group</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($user) != 0)
                        @foreach($user as $use)
                            <tr>
                                <td>{{ $use->username }}</td>
                                <td>{{ \App\Groups::NAMES[$use->group] }}</td>

                                <td>
                                    <form class="text-right" action="{{ 'user/'.$use->_id.'/edit' }}" method="POST">
                                        <input type="hidden" name="_method" value="GET">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <button type="submit" class="btn-empty">
                                            <span class="oi oi-pencil"></span>
                                        </button>
                                    </form>
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

            <div class="text-right">
                <a href="/user/create">
                    <button type="button" class="btn btn-primary">Create User</button>
                </a>
            </div>
        </div>
    </div>
@endsection