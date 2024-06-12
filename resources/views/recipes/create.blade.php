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
        
        <div id="steps">
            <input type="text" name="version_name" placeholder="この手順のタイトル　(Ex:First instruction)" class="">
                @for($i = 1; $i < 4; $i++)
                <div class="step">
                        <p class="step-number">手順{{$i}}</p>
                        <img class="handle" src="{{ asset('images/index/swapVert.svg') }}" alt="">
                        <input type="text" name="steps[]" placeholder="手順を入力" class="">
                        <a href="{{ route('recipe.changeHistory') }}"><img src="{{ asset('images/index/history.svg') }}" alt="変更履歴"></a>
                </div>
                @endfor

            <!-- add button -->
            <div>
                <button type="button" id="step-add" class="">手順を追加する</button>
            </div>
        </div>

        <textarea type="text" name="comment" id="" placeholder="レシピエピソードなどのコメント"></textarea><br>
        <textarea type="text" name="memo" id="" placeholder="メモ（一般公開はされません）"></textarea>
        <p class="">
            <button class="" type="submit" name="status" value="draft">下書き保存</button>
            <button class="" type="submit" name="status" value="publish">公開設定</button>
        </p>
    </form>
</section>

<script>
    window.onload = function() {
        let steps = document.getElementById('steps');

        Sortable.create(steps, {
            animation: 150,
            handle: '.handle',
            onEnd: function(evt) {
                var items = steps.querySelectorAll('.step');
                items.forEach(function(item, index) {
                    item.querySelector('.step-number').innerHTML = '手順' + (index + 1);
                });
            }
        });
    };
</script>

@endsection