<x-app-layout>

    <section class="container m-8">
        <div>
            <p class="tcl text-4xl font-extrabold dark:text-slate-500">ブックマーク</p>
                @if($bookmarkedArticles->isEmpty() && $bookmarkedRecipes->isEmpty())
                    <p class="m-3 tcl dark:text-slate-500">ブックマークした記事／レシピはありません</p>
                @else
                    @foreach($bookmarkedArticles as $article)
                        <div class="container m-8 bg-white rounded-lg shadow">
                            <a class="m-1" href="{{ route('article.show', ['article' => $article->id]) }}">
                                <div class="flex">
                                    <p class="mx-5 tcl">記事</p>
                                    <img class="w-48" src="{{ asset('storage/' . $article->image) }}" alt="">
                                    <div class="ml-5 leading-relaxed">
                                        <p class="text-base tcl">@ {{ $article['user']['name'] }}</p>
                                        <p class="text-xs text-slate-400">{{ $article->updated_at }}</p>
                                        <p class="text-2xl font-bold text-pretty tcl">{{ $article->title }}</p>
                                        <p class="text-base text-slate-500">{{ $article->tags }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    @foreach($bookmarkedRecipes as $recipe)
                        <div class="container m-8 bg-white rounded-lg shadow">
                            <a class="m-1" href="{{ route('recipe.show', ['recipe' => $recipe->id]) }}">
                                <div class="flex">
                                    <p class="mx-5 tcl">レシピ</p>
                                    <img class="w-48" src="{{ asset('storage/' . $recipe->image) }}" alt="">
                                    <div class="ml-5 leading-relaxed">
                                        <p class="text-base tcl">@ {{ $recipe['user']['name'] }}</p>
                                        <p class="text-xs text-slate-400">{{ $recipe->updated_at }}</p>
                                        <p class="text-2xl font-bold text-pretty tcl">{{ $recipe->title }}</p>
                                        <p class="text-base text-slate-500">{{ $recipe->tags }}</p>
                                        <p class="text-base line-clamp-3 tcl">{{ $recipe->intro }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
        </div>
    </section>

</x-app-layout>
