<x-app-layout>
<section class="container mx-3">

<h3 class="text-2xl font-bold text-pretty tcl">【{{ $recipe['title'] }}】</h3>
<p class="text-base text-slate-500">{{ $recipe['tags'] }}</p>
<h4 class="text-base tcl text-right">by {{ $recipe['user']['name'] }}</h4>

<div>
    <img class="w-80" src="{{ asset('storage/'. $recipe['image']) }}" alt="{{ $recipe['title'] }}">
</div>
<div>
    <p class="tcl text-base my-3">レシピ背景などのエピソード：</p>
    <p class="m-4 rounded text-base tcl bg-white">{{ $recipe['comment'] }}</p>
    <p class="ing m-4 rounded text-base tcl bg-white"></p>
</div>
<div class="bg-slate-300 rounded py-3">

<?php
    $lastSteps = [];
    $lastStepCreatedAt = $recipe['steps'][count($recipe['steps']) - 1]['created_at'];
?>

@foreach($recipe['steps'] as $s)
    @if ($s['created_at'] == $lastStepCreatedAt)
        @php
            $lastSteps[] = $s;
        @endphp
        <div class="">
            <div class="">
            <p class="m-4 rounded text-base tcl">手順{{ $s['step_number'] }}:</p>
            </div>
            <p class="m-4 rounded text-base tcl bg-white">{{ $s['description'] }}</p>
        </div>
    @endif
@endforeach

<?php $json = json_encode($lastSteps); ?>
</div>

<!-- LIKE機能 -->
<div>
@if($recipe->favorites->where('user_id', Auth::id())->count())
    <form class="m-5" action="{{ route('favorites.recipeDestroy', $recipe) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">Unfavorite</button>
    </form>
@else
    <form class="m-5" action="{{ route('favorites.recipeStore', $recipe) }}" method="POST">
        @csrf
        <button type="submit" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">Favorite</button>
    </form>
@endif
</div>

<!-- Bookmark機能 -->
<div>
@if($recipe->bookmarks->where('user_id', Auth::id())->count())
    <form class="m-5" action="{{ route('bookmarks.recipeDestroy', $recipe) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">Unbookmark</button>
    </form>
@else
    <form class="m-5" action="{{ route('bookmarks.recipeStore', $recipe) }}" method="POST">
        @csrf
        <button type="submit" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">Bookmark</button>
    </form>
@endif
</div>

<!-- SNS各種のシェアボタン -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v20.0" nonce="BkDmKogm"></script>
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェアする</a></div>
<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="touch-counter" data-hatena-bookmark-width="40" data-hatena-bookmark-height="40" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>

</section>

<script>
    //材料の抽出
    function parseStep(step) {
        const ingredientPattern = /@(.+?)\{(.*?)\}/g;
        let match;
        const results = [];

        while ((match = ingredientPattern.exec(step)) !== null) {
            const ingredient = match[1];
            const quantity = match[2];

            results.push({
            ing: ingredient,
            quantity: quantity
            });
        }

        return results;
    }


    let jsonData = JSON.parse('<?=$json?>');
    // console.log(jsonData);
    for(const element of jsonData) {
        let step = parseStep(element.description);
        console.log(step);

        // 既存の <p class="ing"></p> を取得
        let pElement = document.querySelector('.ing');

        // 取得した <p> 要素に step を追加
        if (pElement) {
            for (const e of step) {
                pElement.innerHTML += e.ing + ":" + e.quantity + '<br>';
            }
        } else {
            console.error('No element with class "ing" found.');
        }
    }

    //
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!@json(Auth::check())) {
                    event.preventDefault();
                    window.location.href = '{{ route('login') }}';
                }
            });
        });
    });

    
</script>

</x-app-layout>