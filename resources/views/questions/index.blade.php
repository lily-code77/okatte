@extends('layouts.default')

@section('content')
<section class="">
    <div class="q_buttons">
        <div><a href="/questions/create"><button class="btn" type="button" name="all">質問を<br>新規作成</button></a></div>
        <div class="headerbtn mt left-side"><a href=""><button class="btn" type="button" name="all">すべて</button></a></div>
        <div class="headerbtn mt"><a href=""><button class="btn" type="button" name="active">回答募集中</button></a></div>
        <div class="headerbtn mt"><a href=""><button class="btn" type="button" name="closed">クローズ</button></a></div>
    </div>
</section>

<section>
    <h1>質問一覧</h1>
    <tbody>
        @foreach($questions as $question)
        <tr>
            <div class="q_wrapper">
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
    </tbody>
</section>


@endsection