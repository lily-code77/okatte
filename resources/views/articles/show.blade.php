<x-app-layout>
    <section class="container mx-3">
        <div class="flex flex-col md:flex-row items-center md:items-start md:justify-between">
            <h3 class="pt-2 text-2xl font-bold text-pretty tcl dark:text-slate-500 md:w-3/4">{{ $article['title'] }}</h3>
            <h4 class="pt-4 md:pt-2 text-base tcl text-right dark:text-slate-500 md:w-1/4">by {{ $article['user']['name'] }}</h4>
        </div>
        <p class="mt-5 tags text-base tcl dark:text-white">{{ $article['tags'] }}</p>
        <div class="flex justify-center">
            <img class="mt-5 max-w-80 h-auto" src="{{ asset('storage/'. $article['image']) }}" alt="{{ $article['title'] }}">
        </div>
        <div class="bg-white dark:bg-slate-500 mt-5 p-4 rounded">
            <p class="text-base tcl">{!! $article['content'] !!}</p>
        </div>

        <!-- LIKE機能 -->
        <div class="flex justify-center mt-5">
            @if($article->favorites->where('user_id', Auth::id())->count())
                <form id="unfavorite-form" action="{{ route('favorites.destroy', $article) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="focus:outline-none button dark:bg-gray-500 dark:text-white font-medium rounded text-sm px-5 py-2.5">Unfavorite</button>
                </form>
            @else
                <form id="favorite-form" action="{{ route('favorites.store', $article) }}" method="POST">
                    @csrf
                    <button type="submit" class="focus:outline-none button dark:bg-gray-500 dark:text-white font-medium rounded text-sm px-5 py-2.5">Favorite</button>
                </form>
            @endif
        </div>

        <!-- Bookmark機能 -->
        <div class="flex justify-center mt-5">
            @if($article->bookmarks->where('user_id', Auth::id())->count())
                <form action="{{ route('bookmarks.destroy', $article) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="focus:outline-none button dark:bg-gray-500 dark:text-white font-medium rounded text-sm px-5 py-2.5">Unbookmark</button>
                </form>
            @else
                <form action="{{ route('bookmarks.store', $article) }}" method="POST">
                    @csrf
                    <button type="submit" class="focus:outline-none button dark:bg-gray-500 dark:text-white font-medium rounded text-sm px-5 py-2.5">Bookmark</button>
                </form>
            @endif
        </div>

        <!-- SNS各種のシェアボタン -->
        <div class="flex justify-center mt-5 space-x-4">
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v20.0" nonce="BkDmKogm"></script>
            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small">
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェアする</a>
            </div>
            <div>
                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div>
                <a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="touch-counter" data-hatena-bookmark-width="40" data-hatena-bookmark-height="40" title="このエントリーをはてなブックマークに追加">
                    <img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" />
                </a>
                <script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
            </div>
        </div>
    </section>

    <script>
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
