<x-app-layout>

    <div class="container">
    {{ __("ブックマーク") }}
        @if($bookmarkedArticles->isEmpty())
            <p>ブックマークした記事／レシピはありません</p>
        @else
            <ul class="list-group">
                @foreach($bookmarkedArticles as $article)
                    <li class="list-group-item">
                        <a href="{{ route('article.show', $article->id) }}">
                            <img class=q_img src="{{ asset('storage/' . $article->image) }}" alt="">
                            {{ $article->title }}
                        </a>
                    </li>
                @endforeach
                @foreach($bookmarkedRecipes as $recipe)
                    <li class="list-group-item">
                        <a href="{{ route('recipe.show', $recipe->id) }}">
                            <img class=q_img src="{{ asset('storage/' . $recipe->image) }}" alt="">
                            {{ $recipe->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</x-app-layout>
