@extends('base')

@section('content')

    <h1>{{ @$tag ? "&#35;{$tag}" : 'TheJournal.ie' }}</h1>

    @if (count(@$data) > 0)
        @foreach ($data as $article)
            <div class="clearfix">
                <div style="float: left; margin-right: 20px;">
                    <a href="/article/{{ $article->getId() }}" style="width:230px; height:150px;">
                        <img src="{{ $article->getImage() }}" width="230" height="150" style="width:230px; height:150px;" />
                    </a>
                </div>
                <div>
                    <h4> <a href="/article/{{ $article->getId() }}">{{ $article->getTitle() }}</a></h4>
                    <p>{{ $article->getExcerpt() }}</p>
                </div>
            </div>
            <hr>
        @endforeach
    @else
        No articles found
    @endif

@endsection {{-- /content --}}
