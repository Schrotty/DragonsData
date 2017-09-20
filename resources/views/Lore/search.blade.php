@extends('layout.app')

@section('content')
    @foreach($result as $entry)
        <div id="{{ '/' . $entry->getModelName() . '/' . $entry->getValue('_id') }}" class="card mb-3 pointer card-clickabe">
            <div class="card-body">
                <h2>
                    <span>{{ $entry->getValue('name') }}</span>
                </h2>

                <p>
                    <i>{{ $entry->getValue('teaser') }}</i>
                </p>
            </div>
        </div>
    @endforeach
@endsection