@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @foreach($posts as $post)
                <div class="blog-post">
                    <h2>
                        <span>{{ $post->getValue('title') }}</span>
                    </h2>

                    {!! $post->post() !!}
                </div>
            @endforeach
        </div>
    </div>
@endsection