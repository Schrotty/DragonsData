@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{trans('realm.realms')}}</div>
                <div class="panel-body">
                    @if( count(Auth::user()->knownRealms()) != 0 )
                        <table class="realm-table">
                            <tr>
                                <th>{{ trans('general.name') }}</th>
                                <th>{{ trans('general.description') }}</th>
                            </tr>

                            @foreach(Auth::user()->knownRealms() as $oRealm)
                                <tr>
                                    <td><a href="{{ '/realm/' . $oRealm->id }}">{{ $oRealm->name }}</a></td>
                                    <td>{{ $oRealm->shortDescription }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        {{ trans('user.no_assigned_realms') }}
                    @endif
                </div>
            </div>
        </div>

        @include('sidebar')
    </div>
</div>
@endsection
