<x-app-layout>

<section class="">
    <!-- 項目毎ではなく、ごちゃまぜの最新順にでるように書き換え必要 -->
    @foreach($myArticles as $myArticle)
        @if ($myArticle['status'] == 'publish')
            <div class="container m-8 bg-white rounded-lg shadow">
                <a class="m-1" href="{{ route('article.show', ['article' => $myArticle->id]) }}">
                    <div class="flex">
                        <p class="mx-5 tcl">記事</p>
                        <img class="w-48" src="{{ asset('storage/' . $myArticle->image) }}" alt="">
                        <div class="ml-5 leading-relaxed">
                            <p class="text-base tcl">@ {{ $myArticle['user']['name'] }}</p>
                            <p class="text-xs text-slate-400">{{ $myArticle->updated_at }}</p>
                            <p class="text-2xl font-bold text-pretty tcl">{{ $myArticle->title }}</p>
                            <p class="text-base text-slate-500">{{ $myArticle->tags }}</p>
                        </div>
                    </div>
                </a>
            </div>
            
        @endif
    @endforeach
    <!-- ページャー -->
    <div class="mx-5">
        {{ $myArticles->links() }}
    </div>

    @foreach($myRecipes as $myRecipe)
        @if ($myRecipe['status'] == 'publish')
            <div class="container m-8 bg-white rounded-lg shadow">
                <a class="m-1" href="{{ route('recipe.show', ['recipe' => $myRecipe->id]) }}">
                    <div class="grid grid-cols-10 gap-4">
                        <p class="mx-5 tcl">レシピ</p>
                        <img class="col-span-2" src="{{ asset('storage/' . $myRecipe->image) }}" alt="">
                        <div class="col-span-4 leading-relaxed">
                            <p class="text-base tcl">@ {{ $myRecipe['user']['name'] }}</p>
                            <p class="text-xs text-slate-400">{{ $myRecipe->updated_at }}</p>
                            <p class="text-2xl font-bold text-pretty tcl">{{ $myRecipe->title }}</p>
                            <p class="text-base text-slate-500">{{ $myRecipe->tags }}</p>
                            <p class="text-base line-clamp-3 tcl">{{ $myRecipe->intro }}</p>
                        </div>
                        <div></div>
                        <div class="text-right">
                            <form method="POST" action="{{ route('recipe.clone', ['recipe' => $myRecipe->id ])}}">
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
        {{ $myRecipes->links() }}
    </div>
</section>
</x-app-layout>