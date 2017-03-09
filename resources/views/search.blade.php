@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">
                <span class="panel-title">
                    Results
                </span>
            </span>
        </div>

        <div class="panel-body">
            @if($aResults['total'] >= 1)
                @foreach($aResults['hits'] as $aResult)
                    @include('widget.result', $aResult)
                @endforeach
            @else
                {{ trans('general.no_result_found') }}
            @endif
        </div>
    </div>
@endsection
