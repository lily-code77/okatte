<x-app-layout>
<section class="container mx-3">
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
                        <img class="step-delete" src="{{ asset('images/index/delete.svg') }}" alt="削除する">
                </div>
                @endfor

        </div>
        <!-- add button -->
        <div>
            <button type="button" id="step-add" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">手順を追加する</button>
        </div>
        <textarea type="text" name="comment" id="" placeholder="レシピエピソードなどのコメント"></textarea><br>
        <textarea type="text" name="memo" id="" placeholder="メモ（一般公開はされません）"></textarea>
        <p class="">
            <button class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="submit" name="status" value="draft">下書き保存</button>
            <button class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="submit" name="status" value="publish">公開設定</button>
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
</x-app-layout>