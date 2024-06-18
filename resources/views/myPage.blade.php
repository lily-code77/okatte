<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('マイページ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("記事一覧") }}
                    @foreach($myArticles as $myArticle)
                    <a href="{{ route('article.show', ['article' => $myArticle->id]) }}">
                        <tr>
                            <div class="q_wrapper">
                                <td>
                                    <div class="q_list">
                                        <img class=q_img src="{{ asset('storage/' . $myArticle->image) }}" alt="">
                                    </div>
                                </td>
                                <td>
                                    <div class="q_list_content">
                                        <p class="q_list_title">{{ $myArticle->title }}</p>
                                        <p class="q_list_tags">{{ $myArticle->tags }}</p>
                                        <p class="q_list_updated">{{ $myArticle->updated_at }}</p>
                                    </div>
                                </td>
                            </div>
                            <div>
                                <div>
                                    <form action="{{ route('article.edit', ['article' => $myArticle->id]) }}" method="GET">
                                    @csrf

                                        <button type="submit"  class="btn bg-blue-500 rounded-lg">
                                            更新
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <form action="{{ route('article.destroy', ['article' => $myArticle->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                
                                        <button type="submit"  class="btn bg-blue-500 rounded-lg">
                                            削除
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </tr>
                    </a>
                    @endforeach
                    <!-- ページャー -->
                    {{ $myArticles->links() }}
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("レシピ一覧") }}
                    @foreach($myRecipes as $myRecipe)
                    <a href="{{ route('recipe.show', ['recipe' => $myRecipe->id]) }}">
                        <tr>
                            <div class="q_wrapper">
                                <td>
                                    <div class="q_list">
                                        <img class=q_img src="{{ asset('storage/' . $myRecipe->image) }}" alt="">
                                    </div>
                                </td>
                                <td>
                                    <div class="q_list_content">
                                        <p class="q_list_title">{{ $myRecipe->title }}</p>
                                        <p class="q_list_tags">{{ $myRecipe->tags }}</p>
                                        <p class="q_list_updated">{{ $myRecipe->updated_at }}</p>
                                    </div>
                                </td>
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
                        </tr>
                    </a>
                    @endforeach
                    <!-- ページャー -->
                    {{ $myRecipes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
