@extends('layout.app')

@section('content')
    <div class="row">
        @foreach($items as $item)
            <div class="col">
                <div id="{{ $item->getValue('_id') }}" class="card pointer card-clickabe">
                    <div class="card-body">
                        <h4 class="card-title">
                            <span>{{ $item->getValue('name') }}</span>
                            <small class="text-muted">{{ $item->category()->getValue('name') }}</small>
                        </h4>

                        <p>
                            <i>{{ $item->getValue('teaser') }}</i>
                        </p>
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
        @endforeach
    </div>
@endsection