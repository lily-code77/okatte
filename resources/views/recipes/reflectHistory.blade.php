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
        <input type="text" value="{{$recipe['steps'][(count($recipe['steps'])-1)]['version_name']}}" name="version_name" placeholder="この手順のタイトル　(Ex:手順を更新する理由)" class="">
            @foreach($recipe['steps'] as $i => $os)
                @if ($os['created_at'] == $recipe['steps'][(count($recipe['steps'])-1)]['created_at'])
                    <div class="step">
                            <p class="step-number">手順{{$os['step_number']}}</p>
                            <img class="handle" src="{{ asset('images/index/swapVert.svg') }}" alt="">
                            @if ($os['id'] == $step_id)
                                <input type="text" value="{{$posts['reflectDescription']}}" name="steps[]" placeholder="手順を入力" class="">
                            @else
                                <input type="text" value="{{$os['description']}}" name="steps[]" placeholder="手順を入力" class="">
                            @endif
                            <a href="{{ route('recipe.changeHistory',  ['recipe' => $recipe['id'], 'step' => $os['id']]) }}"><img src="{{ asset('images/index/history.svg') }}" alt="変更履歴"></a>
                            <img class="step-delete" src="{{ asset('images/index/delete.svg') }}" alt="削除する">
                    </div>
                @endif
            @endforeach
        </div>
        <!-- add button -->
        <div>
            <button type="button" id="step-add" class="">手順を追加する</button>
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
            handle: '.handle',
            onEnd: function(evt) {
                var items = steps.querySelectorAll('.step');
                items.forEach(function(item, index) {
                    item.querySelector('.step-number').innerHTML = '手順' + (index + 1);
                });
            }
        });
    };

    document.getElementById('steps').addEventListener('click', function(evt) {
        if (evt.target.classList.contains('step-delete')) {
            evt.target.closest('.step').remove();
        }
    });

    document.getElementById('step-add').addEventListener('click', function() {
        let stepCount = steps.querySelectorAll('.step').length;
        let step = document.createElement('div');
        step.classList.add('step');
        step.innerHTML = `<p class="step-number">手順${stepCount + 1}</p>
                        <img class="handle" src="{{ asset('images/index/swapVert.svg') }}" alt="">
                        <input type="text" name="steps[]" placeholder="手順を入力" class="">
                        <img class="step-delete" src="{{ asset('images/index/delete.svg') }}" alt="削除する">`;

        steps.appendChild(step);
    })
</script>
@endsection