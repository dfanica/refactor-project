@extends('base')

@section('content')
    @if (!$data->getId())
        Article not found
    @else
        <h1>{{ $data->getTitle() }}</h1>

        {!! $data->getContent() !!}

        <p>
            <strong>Tags:</strong>
            @foreach ($data->getTags() as $tag)
                <a href="/tag/{{ $tag }}">{{ $tag }}</a>@if (!$loop->last),@endif
            @endforeach
        </p>
    @endif

@endsection {{-- /content --}}
