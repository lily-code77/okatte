@extends('layouts.plain')

@section('content')
<section>
<h3>【{{ $recipe['title'] }}】</h3>
<p>{{ $recipe['tags'] }}</p>
<h4>made by {{ $recipe['user']['name'] }}</h4>
<p>{{ $recipe['intro'] }}</p>

<div>
    <img src="{{ asset('storage/'. $recipe['image']) }}" alt="{{ $recipe['title'] }}">
</div>
<div>
    <p>{{ $recipe['comment'] }}</p>
    <p>{{ $recipe['ing'] }}</p>
</div>
<div>
@foreach($recipe['steps'] as $s)
    @if ($s['created_at'] == $recipe['steps'][(count($recipe['steps'])-1)]['created_at'])
        <div class="">
            <div class="">
            <p>手順{{ $s['step_number'] }}</p>
            </div>
            <p>{{ $s['description'] }}</p>
        </div>
    @endif
@endforeach
</div>

<!-- SNS各種のシェアボタン -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v20.0" nonce="BkDmKogm"></script>
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェアする</a></div>
<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="touch-counter" data-hatena-bookmark-width="40" data-hatena-bookmark-height="40" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>


</section>


@endsection