@extends('layouts.default')

@section('content')
<section class="">
    <form action="{{ route('recipe.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" class="" placeholder="レシピのタイトル"><br>
        <input type="text" name="tags" class="" placeholder="タグをスペース区切りで入力してください（最大5つまで）"><br>
        <input type="text" name="intro" class="" placeholder="レシピの紹介文"><br>
        <input type="file" name="image" accept='image/*' class=""><br>
        <textarea type="text" name="ing" id="" placeholder="材料"></textarea><br>
        
            @for($i = 1; $i < 4; $i++)
            <div class="step">
                <div class="">
                    手順{{$i}}
                    <img src="{{ asset('images/index/swapVert.svg') }}" alt="">
                    <input type="text" name="steps[]" placeholder="手順を入力" class="">
                    <button type="button" class="">変更履歴</button>
                    <!-- <button type="button" class="">更新</button> -->
                </div>
            </div>
            @endfor

        <!-- add button -->
        <div>
            <button type="button" id="step-add" class="">手順を追加する</button>
        </div>

        <textarea type="text" name="comment" id="" placeholder="レシピエピソードなどのコメント"></textarea><br>
        <textarea type="text" name="memo" id="" placeholder="メモ（一般公開はされません）"></textarea>
        <p class="">
            <button class="" type="submit" name="status" value="draft">下書き保存</button>
            <button class="" type="submit" name="status" value="publish">公開設定</button>
        </p>
    </form>
</section>

@endsection