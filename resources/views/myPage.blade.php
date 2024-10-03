<x-app-layout>
    <div class="container m-8">
        <!-- <p class="tcl text-4xl font-extrabold dark:text-slate-500">{{ __("記事一覧") }}</p> -->
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col md:flex-row justify-around flex-wrap -m-4">
                @foreach($myArticles as $myArticle)
                <div class="p-4 m-4 w-full md:w-1/3 rounded border bg-white flex-1">
                    <a href="{{ route('article.show', ['article' => $myArticle->id]) }}">
                        <div class="">
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('storage/' . $myArticle->image) }}" alt="">
                        </div>
                        <div class="mt-4">
                            @if ($myArticle['status'] == 'draft')
                            <p class="p-3 text-base bg-slate-600 text-white">下書き中</p>
                            @endif
                            <p class="text-2xl font-bold text-pretty tcl">{{ $myArticle->title }}</p>
                            <div class="mt-2 flex">
                                <p class="flex items-center"><img src="{{ asset('images/index/bookmark.svg') }}" alt="Bookmarks" class="mr-1">: {{ $myArticle->bookmarks_count }}</p>
                                <p class="ml-5 flex items-center"><img src="{{ asset('images/index/favorite.svg') }}" alt="Favorites" class="mr-1">: {{ $myArticle->favorites_count }}</p>
                            </div>

                            <!-- Tags display logic -->
                            <p>
                                @foreach(explode(' ', $myArticle->tags) as $tag)
                                <span class="tags text-base text-white">{{ $tag }}</span>
                                @endforeach
                            </p>

                            <p class="text-xs text-slate-400 mt-1">{{ $myArticle->updated_at }}</p>
                        </div>
                        <div class="flex mt-3">
                            <form action="{{ route('article.edit', ['article' => $myArticle->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2">更新</button>
                            </form>
                            <form action="{{ route('article.destroy', ['article' => $myArticle->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2">削除</button>
                            </form>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ページャー -->
        <div>
            {{ $myArticles->links() }}
        </div>
    </div>
    <div class="container m-8">
        <p class="tcl text-4xl font-extrabold dark:text-slate-500">{{ __("レシピ一覧") }}</p>
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col md:flex-row justify-around flex-wrap -m-4">
                @foreach($myRecipes as $myRecipe)
                <div class="p-4 m-4 w-full md:w-1/3 rounded border bg-white flex-1">
                    <a href="{{ route('recipe.show', ['recipe' => $myRecipe->id]) }}">
                        <div class="">
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('storage/' . $myRecipe->image) }}" alt="">
                        </div>
                        <div class="mt-4">
                            @if ($myRecipe['status'] == 'draft')
                            <p class="p-3 text-base bg-slate-600 text-white">下書き中</p>
                            @endif
                            <p class="text-2xl font-bold text-pretty tcl">{{ $myRecipe->title }}</p>
                            <div class="mt-2 flex">
                                <p class="flex items-center"><img src="{{ asset('images/index/bookmark.svg') }}" alt="Bookmarks" class="mr-1">: {{ $myRecipe->bookmarks_count }}</p>
                                <p class="ml-5 flex items-center"><img src="{{ asset('images/index/favorite.svg') }}" alt="Favorites" class="mr-1">: {{ $myRecipe->favorites_count }}</p>
                            </div>

                            <!-- Tags display logic -->
                            <p>
                                @foreach(explode(' ', $myRecipe->tags) as $tag)
                                <span class="tags text-base text-white">{{ $tag }}</span>
                                @endforeach
                            </p>

                            <p class="text-base tcl mt-1">{{ $myRecipe->intro }}</p>
                            <p class="text-xs text-slate-400 mt-1">{{ $myRecipe->updated_at }}</p>
                        </div>
                        <div class="flex mt-3">
                            <!-- フィードバックボタンを作成する -->
                            <form method="POST" action="{{ route('recipe.feedback', ['recipe' => $myRecipe->id ])}}">
                                @csrf
                                <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2 mb-5">フィードバックする</button>
                            </form>

                            <form action="{{ route('recipe.edit', ['recipe' => $myRecipe->id]) }}" method="GET">
                                @csrf
                                <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2">更新</button>
                            </form>
                            <form method="POST" action="{{ route('recipe.clone', ['recipe' => $myRecipe->id ])}}">
                                @csrf
                                <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2">コピーする</button>
                            </form>
                            <form action="{{ route('recipe.destroy', ['recipe' => $myRecipe->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2">削除</button>
                            </form>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ページャー -->
        <div>
            {{ $myRecipes->links() }}
        </div>
    </div>
</x-app-layout>