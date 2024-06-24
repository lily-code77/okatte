<x-app-layout>
<section class="container mx-3">
    <form action="{{ route('recipe.update',  ['recipe' => $recipe['id']]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="relative m-3">
            <input type="text" id="title_create" name="title" value="{{ old('title', $recipe['title']) }}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
            <label for="title_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">レシピのタイトル</label>
        </div>
        <div class="relative m-3">
            <input type="text" id="tags_create" name="tags" value="{{ old('tags', $recipe['tags']) }}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
            <label for="tags_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">タグをスペース区切りで入力してください（最大5つまで）</label>
        </div>
        <div class="relative m-3">
            <input type="text" id="intro_create" name="intro" value="{{ old('intro', $recipe['intro']) }}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
            <label for="intro_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">レシピの紹介文</label>
        </div>
        <img class="w-80" src="{{ asset('storage/'. $recipe['image']) }}" alt="">
        <div class="m-3">
            <label class="tcl block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image_create">画像</label>
            <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image_create" type="file" accept='image/*'>
        </div>
        <div class="m-3">
            <label class="tcl block my-2 text-sm font-medium">材料</label>
            <p class="block p-5 w-full rounded-lg bg-gradient-to-r from-sky-200 to-indigo-200 text-base font text-sky-700 leading-loose">
                このレシピが保存された後に、手順に入力された材料と分量が自動抽出されます。<br>
                手順欄に材料と分量を、<span class="font-bold">@材料{分量}</span>と記載してください。<br>
                Ex）ボウルに@牛乳{2L}と@砂糖{少々}を加える。
            </p>
        </div>
        <div id="steps" class="bg-slate-300 rounded py-3">
            <div class="relative m-3">
                <input type="text" id="vname_create" name="version_name" value="{{$recipe['steps'][(count($recipe['steps'])-1)]['version_name']}}" class="block px-2.5 pb-2.5 pt-4 w-1/2 text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
                <label for="vname_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">この手順のタイトル　(Ex:First instruction)</label>
            </div>
            @foreach($recipe['steps'] as $i => $os)
                @if ($os['created_at'] == $recipe['steps'][(count($recipe['steps'])-1)]['created_at'])
                    <div class="step flex my-3">
                        <p class="tcl step-number ml-5 mr-3 my-6">手順{{$os['step_number']}}</p>
                        <img class="handle mr-3" src="{{ asset('images/index/swapVert.svg') }}" alt="順序を入れ替える">
                        <div class="relative m-3">
                            <textarea type="text" id="step_create" name="steps[]" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" rows="4" cols="50" placeholder="">{{$os['description']}}</textarea>
                            <label for="step_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">手順を入力</label>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('recipe.changeHistory',  ['recipe' => $recipe['id'], 'step' => $os['id']]) }}"><img src="{{ asset('images/index/history.svg') }}" alt="変更履歴" class="mb-9"></a>
                            <img class="step-delete" src="{{ asset('images/index/delete.svg') }}" alt="削除する">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        
        <!-- add button -->
        <div class="">
            <button type="button" id="step-add" class="my-3 focus:outline-none button font-medium rounded text-sm px-5 py-2.5">手順を追加する</button>
        </div>

        <div class="relative m-3">
            <textarea type="text" id="comment_create" name="comment" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="">{{ old('comment', $recipe['comment']) }}</textarea>
            <label for="comment_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">レシピ背景などのエピソード</label>
        </div>
        <div class="relative m-3">
            <textarea type="text" id="memo_create" name="memo" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="">{{ old('memo', $recipe['memo']) }}</textarea>
            <label for="memo" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">メモ（一般公開はされません）</label>
        </div>

        <p class="">
            <button class="my-3 focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="submit" name="status" value="draft">下書き保存</button>
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
        step.innerHTML = `<div class="step flex my-3">
                        <p class="tcl step-number ml-5 mr-3 my-6">手順${stepCount + 1}</p>
                        <img class="handle mr-3" src="{{ asset('images/index/swapVert.svg') }}" alt="順序を入れ替える">
                        <div class="relative m-3">
                            <textarea type="text" id="step_create" name="steps[]" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-white rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" rows="4" cols="50" placeholder=""></textarea>
                            <label for="step_create" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">手順を入力</label>
                        </div>
                        <img class="step-delete" src="{{ asset('images/index/delete.svg') }}" alt="削除する">
                        </div>`;

        steps.appendChild(step);
    })
</script>
</x-app-layout>