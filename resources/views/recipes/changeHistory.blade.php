<x-app-layout>
<section class="container mx-3">
<h3 class="m-5 text-2xl font-bold text-pretty tcl dark:text-slate-500">【{{ $recipe['title'] }}】_手順の変更履歴一覧</h3>

<form class="m-5" action="{{ route('recipe.reflectHistory',  ['recipe' => $recipe['id'], 'step' => $step]) }}" method="post">
    @csrf
    <div class="flex">
        <p class="m-3 p-3 dark:text-slate-500">作成中のレシピに反映させたい過去の手順を一つ選んでください。</p>
        <button class="focus:outline-none button dark:bg-gray-500 dark:text-white font-medium rounded text-sm px-5" type="submit">反映させる</button>
    </div>
        <div class="m-3 text-base tcl dark:text-slate-500">
            @foreach($recipe['steps'] as $i => $os)
                    @if ($os['step_number'] == 1)
                        <p class="m-3 p-2 rounded text-xl tcl bg-white dark:bg-gray-500 dark:text-white">手順のタイトル => 『 {{$os['version_name']}} 』</p>
                    @endif
                        <input class="m-3" type="radio" name="reflectDescription" value="{{$os['description']}}">手順{{$os['step_number']}} : {{$os['description']}}<br>
            @endforeach
        </div>
</form>




</section>

</x-app-layout>