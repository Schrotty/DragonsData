@extends('layout.app')

@section('content')
    @foreach($parties as $party)
        <div id="{{ '/party/' . $party->getValue('_id') }}" class="card mb-3 pointer card-clickabe">
            <div class="card-body">
                <h4>
                    <span>{{ $party->getValue('name') }}</span>
                </h4>

                <p><i>{{ $party->getValue('description', 'No teaser found') }}</i></p>
            </div>
        </div>
    @endforeach
@endsection