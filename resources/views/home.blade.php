@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">Geographical</span>

            @if(Auth::user()->rank()->is_root)
                <div class="pull-right">
                    <a href="{{ url('realm/create') }}">
                        {{ trans('realm.create') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="panel-body">
            @include('widget.realms', ['realms' => Auth::user()->knownRealms()])
        </div>
    </div>
@endsection
