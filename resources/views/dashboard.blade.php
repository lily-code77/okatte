<x-app-layout>

<section class="">
    <!-- 項目毎ではなく、ごちゃまぜの最新順にでるように書き換え必要 -->
    @foreach($articles as $article)
        @if ($article['status'] == 'publish')
            <div class="container m-8 bg-white rounded-lg shadow">
                <a class="m-1" href="{{ route('article.show', ['article' => $article->id]) }}">
                    <div class="flex">
                        <p class="mx-5 tcl">記事</p>
                        <img class="w-48" src="{{ asset('storage/' . $article->image) }}" alt="">
                        <div class="ml-5 leading-relaxed">
                            <p class="text-base tcl">@ {{ $article['user']['name'] }}</p>
                            <p class="text-xs text-slate-400">{{ $article->updated_at }}</p>
                            <p class="text-2xl font-bold text-pretty tcl">{{ $article->title }}</p>

                            <!-- Tags display logic -->
                            <p>
                                @foreach(explode(' ', $article->tags) as $tag)
                                    <span class="tags text-base text-white">{{ $tag }}</span>
                                @endforeach
                            </p>

                            <div class="flex">
                                <p class="flex"><img src="{{ asset('images/index/bookmark.svg') }}" alt="Bookmarks"> : {{ $article->bookmarks_count }}</p>
                                <p class="ml-5 flex"><img src="{{ asset('images/index/favorite.svg') }}" alt="Favorites"> : {{ $article->favorites_count }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
        @endif
    @endforeach
    <!-- ページャー -->
    <div class="mx-5">
        {{ $articles->links() }}
    </div>

    @foreach($recipes as $recipe)
        @if ($recipe['status'] == 'publish')
            <div class="container m-8 bg-white rounded-lg shadow">
                <a class="m-1" href="{{ route('recipe.show', ['recipe' => $recipe->id]) }}">
                    <div class="grid grid-cols-10 gap-4">
                        <p class="mx-5 tcl">レシピ</p>
                        <img class="col-span-2" src="{{ asset('storage/' . $recipe->image) }}" alt="">
                        <div class="col-span-4 leading-relaxed">
                            <p class="text-base tcl">@ {{ $recipe['user']['name'] }}</p>
                            <p class="text-xs text-slate-400">{{ $recipe->updated_at }}</p>
                            <p class="text-2xl font-bold text-pretty tcl">{{ $recipe->title }}</p>
                            <p class="text-base line-clamp-3 tcl">{{ $recipe->intro }}</p>
                            
                            <!-- Tags display logic -->
                            <p>
                                @foreach(explode(' ', $recipe->tags) as $tag)
                                    <span class="tags text-base text-white">{{ $tag }}</span>
                                @endforeach
                            </p>

                            <div class="flex">
                                <p class="flex"><img src="{{ asset('images/index/bookmark.svg') }}" alt="Bookmarks"> : {{ $recipe->bookmarks_count }}</p>
                                <p class="ml-5 flex"><img src="{{ asset('images/index/favorite.svg') }}" alt="Favorites"> : {{ $recipe->favorites_count }}</p>
                            </div>
                        </div>
                        <div></div>
                        <div class="text-right">
                            <form method="POST" action="{{ route('recipe.clone', ['recipe' => $recipe->id ])}}">
                                @csrf
                                <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2">コピーする</button>
                            </form>
                        </div>
                    </div>
                </a>
            </div>    
        @endif
    @endforeach
    <!-- ページャー -->
    <div class="mx-5">
        {{ $recipes->links() }}
    </div>
</section>
</x-app-layout>