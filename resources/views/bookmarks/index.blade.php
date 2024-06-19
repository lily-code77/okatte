@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ブックマーク</h1>
        @if($bookmarkedArticles->isEmpty())
            <p>ブックマークした記事／レシピはありません</p>
        @else
            <ul class="list-group">
                @foreach($bookmarkedArticles as $article)
                    <li class="list-group-item">
                        <a href="{{ route('article.show', $article->id) }}">
                            <img class=q_img src="{{ asset('storage/' . $article->image) }}" alt="">
                            {{ $article->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
