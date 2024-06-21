<x-app-layout>

    <div class="">
        <div class="container m-8">
            <p class="tcl text-4xl font-extrabold">{{ __("記事一覧") }}</p>
                <div class="container px-5 py-10 mx-auto">
                    <div class="flex justify-around flex-wrap -m-4">
                        @foreach($myArticles as $myArticle)
                            @if ($myArticle['status'] == 'publish')
                                <div class="p-4 m-4 md:w-1/3 rounded border bg-white flex-1">
                                    <a href="{{ route('article.show', ['article' => $myArticle->id]) }}">
                                        <div class="">
                                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('storage/' . $myArticle->image) }}" alt="">
                                        </div>
                                        <div class="">
                                            <p class="text-2xl font-bold text-pretty tcl">{{ $myArticle->title }}</p>
                                            <p class="text-base text-slate-500">{{ $myArticle->tags }}</p>
                                            <p class="text-xs text-slate-400">{{ $myArticle->updated_at }}</p>
                                        </div>
                                        <div class="flex mt-3">
                                            <form action="{{ route('article.edit', ['article' => $myArticle->id]) }}" method="GET">
                                            @csrf
                                                <button type="submit"  class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2">
                                                    更新
                                                </button>
                                            </form>
                                            <form action="{{ route('article.destroy', ['article' => $myArticle->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"  class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-3 py-2 ml-2">
                                                    削除
                                                </button>
                                            </form>
                                        </div>
                                            
                                        
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    </div>
                    
                    <!-- ページャー -->
                    <div>
                        {{ $myArticles->links() }}
                    </div>
        </div>
        <div class="">
                <div class="">
                    {{ __("レシピ一覧") }}
                    @foreach($myRecipes as $myRecipe)
                        @if ($myRecipe['status'] == 'publish')
                            <a href="{{ route('recipe.show', ['recipe' => $myRecipe->id]) }}">
                                    <div class="q_wrapper">
                                            <div class="q_list">
                                                <img class=q_img src="{{ asset('storage/' . $myRecipe->image) }}" alt="">
                                            </div>
                                        
                                            <div class="q_list_content">
                                                <p class="q_list_title">{{ $myRecipe->title }}</p>
                                                <p class="q_list_tags">{{ $myRecipe->tags }}</p>
                                                <p class="q_list_intro">{{ $myRecipe->intro }}</p>
                                                <p class="q_list_updated">{{ $myRecipe->updated_at }}</p>
                                            </div>
                                        
                                    </div>
                                    <div>
                                        <div>
                                            <form action="{{ route('recipe.edit', ['recipe' => $myRecipe->id]) }}" method="GET">
                                            @csrf

                                                <button type="submit"  class="btn bg-blue-500 rounded-lg">
                                                    更新
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <form method="POST" action="{{ route('recipe.clone', ['recipe' => $myRecipe->id ])}}">
                                                @csrf
                                                <button type="submit" class="btn bg-blue-500 rounded-lg">コピーする</button>
                                            </form>
                                        </div>
                                        <div>
                                            <form action="{{ route('recipe.destroy', ['recipe' => $myRecipe->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                        
                                                <button type="submit"  class="btn bg-blue-500 rounded-lg">
                                                    削除
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                
                            </a>
                        @endif
                    @endforeach
                    <!-- ページャー -->
                    {{ $myRecipes->links() }}
                </div>
        </div>
    </div>
</x-app-layout>
