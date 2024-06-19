@extends('layouts.plain')

@section('content')
<section>
<h3>【{{ $article['title'] }}】</h3>
<p>{{ $article['tags'] }}</p>
<h4>made by {{ $article['user']['name'] }}</h4>

<div>
    <img src="{{ asset('storage/'. $article['image']) }}" alt="{{ $article['title'] }}">
</div>
<div>
    <p>{!! $article['content'] !!}</p>
</div>

<!-- LIKE機能 -->
<div>
@if($article->favorites->where('user_id', Auth::id())->count())
    <form action="{{ route('favorites.destroy', $article) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Unfavorite</button>
    </form>
@else
    <form action="{{ route('favorites.store', $article) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Favorite</button>
    </form>
@endif
</div>

<!-- Bookmark機能 -->
<div>
@if(Auth::check())
    @if(Auth::user()->bookmarkedArticles->contains($article->id))
        <form action="{{ route('bookmarks.destroy', $article) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Unbookmark</button>
        </form>
    @else
        <form action="{{ route('bookmarks.store', $article) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Bookmark</button>
        </form>
    @endif
@endif
</div>

<!-- SNS各種のシェアボタン -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v20.0" nonce="BkDmKogm"></script>
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェアする</a></div>
<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="touch-counter" data-hatena-bookmark-width="40" data-hatena-bookmark-height="40" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
</section>


@endsection