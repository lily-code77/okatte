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
@foreach($questions as $question)
    <tr>
        <div class="q_wrapper">
            <p>質問</p>
            <td>
                <div class="q_list">
                    <img class=q_img src="{{ asset('storage/' . $question->image) }}" alt="">
                </div>
            </td>
            <td>
                <div class="q_list_content">
                    <p class="q_list_title">{{ $question->title }}</p>
                    <p class="q_list_tags">{{ $question->tags }}</p>
                    <p class="q_list_updated">{{ $question->updated_at }}</p>
                </div>
            </td>
        </div>
    </tr>
@endforeach
@foreach($articles as $article)
    <tr>
        <div class="q_wrapper">
            <p>記事</p>
            <td>
                <div class="q_list">
                    <img class=q_img src="{{ asset('storage/' . $article->image) }}" alt="">
                </div>
            </td>
            <td>
                <div class="q_list_content">
                    <p class="q_list_title">{{ $article->title }}</p>
                    <p class="q_list_tags">{{ $article->tags }}</p>
                    <p class="q_list_updated">{{ $question->updated_at }}</p>
                </div>
            </td>
        </div>
    </tr>
@endforeach
@foreach($recipes as $recipe)
    <tr>
        <div class="q_wrapper">
            <p>レシピ</p>
            <td>
                <div class="q_list">
                    <img class=q_img src="{{ asset('storage/' . $recipe->image) }}" alt="">
                </div>
            </td>
            <td>
                <div class="q_list_content">
                    <p class="q_list_title">{{ $recipe->title }}</p>
                    <p class="q_list_tags">{{ $recipe->tags }}</p>
                    <p class="q_list_updated">{{ $recipe->updated_at }}</p>
                </div>
            </td>
        </div>
    </tr>
@endforeach
</section>

@endsection