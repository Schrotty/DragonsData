@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col">
            {{ $item->getValue('name') }}
        </div>
    </div>
@endsection