<x-app-layout>

<section class="">
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
                            <p class="tags text-base text-white">{{ $article->tags }}</p>
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
            <div class="flex">
                <p class="mx-5 tcl">レシピ</p>
                <img class="w-48" src="{{ asset('storage/' . $recipe->image) }}" alt="">
                <div class="ml-5 leading-relaxed">
                    <p class="text-base tcl">@ {{ $recipe['user']['name'] }}</p>
                    <p class="text-xs text-slate-400">{{ $recipe->updated_at }}</p>
                    <p class="text-2xl font-bold text-pretty tcl">{{ $recipe->title }}</p>
                    <p class="text-base line-clamp-3 tcl">{{ $recipe->intro }}</p>
                    <p class="tags text-sm text-white">{{ $recipe->tags }}</p>
                    <div class="flex">
                        <p class="flex"><img src="{{ asset('images/index/bookmark.svg') }}" alt="Bookmarks"> : {{ $recipe->bookmarks_count }}</p>
                        <p class="flex ml-5"><img src="{{ asset('images/index/favorite.svg') }}" alt="Favorites"> : {{ $recipe->favorites_count }}</p>
                    </div>
                    
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