@extends('layouts.default')

@section('content')
<section class="">
    <form action="{{ route('recipe.update',  ['recipe' => $recipe['id']]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" class="" value="{{ old('title', $recipe['title']) }}" placeholder="レシピのタイトル"><br>
        <input type="text" name="tags" class="" value="{{ old('tags', $recipe['tags']) }}" placeholder="タグをスペース区切りで入力してください（最大5つまで）"><br>
        <input type="text" name="intro" class="" value="{{ old('intro', $recipe['intro']) }}" placeholder="レシピの紹介文"><br>
        <img src="{{ asset('storage/'. $recipe['image']) }}" alt="">
        <input type="file" name="image" accept='image/*' class=""><br>
        <textarea type="text" name="ing" id="" placeholder="材料">{{ old('ing', $recipe['ing']) }}</textarea><br>
        
        <div id="steps">
            @foreach($recipe['steps'] as $i => $os)
            <input type="text" value="{{$os['version_name']}}" name="version_name" placeholder="手順を更新する理由/コメント" class="">
                <div class="step">
                        <p>手順{{$os['step_number']}}</p>
                        <img src="{{ asset('images/index/swapVert.svg') }}" alt="">
                        <input type="text" value="{{$os['description']}}" name="steps[]" placeholder="手順を入力" class="">
                        <button type="button" class="">変更履歴</button>
                        <!-- <button type="button" class="">更新</button> -->
                </div>
            @endforeach

            <!-- add button -->
            <div>
                <button type="button" id="step-add" class="">手順を追加する</button>
            </div>
        </div>

        <textarea type="text" name="comment" id="" placeholder="レシピエピソードなどのコメント">{{ old('comment', $recipe['comment']) }}</textarea><br>
        <textarea type="text" name="memo" id="" placeholder="メモ（一般公開はされません）">{{ old('memo', $recipe['memo']) }}</textarea>
        <p class="">
            <button class="" type="submit" name="status" value="draft">下書き保存</button>
            <button class="" type="submit" name="status" value="publish">公開設定</button>
        </p>
    </form>
        
    <form action="">
        <button class="" type="submit" name="" value="">新たなレシピとして公開する</button>
    </form>
</section>

<script>
    window.onload = function() {
        let steps = document.getElementById('steps');

        Sortable.create(steps, {
            animation: 150,
            // handle: '.handle',
        });
    };
</script>
@endsection