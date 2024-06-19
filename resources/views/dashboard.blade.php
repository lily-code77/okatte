@extends('layouts.default')
@section('title', 'トップページ')

@section('content')
<section class="">
    <div class="">
    <h1 class="">開催中の記事投稿キャンペーン</h1>
    <a class="campaign" href="/campaign">バナー</a>
    </div>
</section>

<section class="">
<!-- 項目毎ではなく、ごちゃまぜの最新順にでるように書き換え必要 -->
@foreach($myArticles as $myArticle)
    @if ($myArticle['status'] == 'publish')
        <a href="{{ route('article.show', ['article' => $myArticle->id]) }}">
            <tr>
                <div class="q_wrapper">
                    <p>記事</p>
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
            </tr>
        </a>
    @endif
@endforeach
<!-- ページャー -->
{{ $myArticles->links() }}

@foreach($myRecipes as $myRecipe)
    @if ($myRecipe['status'] == 'publish')
        <a href="{{ route('recipe.show', ['recipe' => $myRecipe->id]) }}">
            <tr>
                <div class="q_wrapper">
                    <p>レシピ</p>
                    <td>
                        <div class="q_list">
                            <img class=q_img src="{{ asset('storage/' . $myRecipe->image) }}" alt="">
                        </div>
                    </td>
                    <td>
                        
                        <div class="q_list_content">
                            <p class="q_list_title">{{ $myRecipe->title }}</p>
                            <p class="q_list_tags">{{ $myRecipe->tags }}</p>
                            <p class="q_list_intro">{{ $myRecipe->intro }}</p>
                            <p class="q_list_updated">{{ $myRecipe->updated_at }}</p>
                        </div>
                    </td>
                </div>
            </tr>
        </a>
    @endif
@endforeach
<!-- ページャー -->
{{ $myRecipes->links() }}
</section>

@endsection