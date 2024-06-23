<x-app-layout>
<section class="container mx-3">
<h3 class="text-2xl font-bold text-pretty tcl">【{{ $recipe['title'] }}】_手順の変更履歴一覧</h3>

<form class="m-5" action="{{ route('recipe.reflectHistory',  ['recipe' => $recipe['id'], 'step' => $step]) }}" method="post">
    @csrf 
    <button class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5" type="submit">反映させる</button>
        <p class="m-3">作成中のレシピに反映させたい過去の手順を一つ選んでください。</p>
            <div class="m-3">
                @foreach($recipe['steps'] as $i => $os)
                        @if ($os['step_number'] == 1)
                            <p class="text-xl tcl bg-white">手順のタイトル=>{{$os['version_name']}}</p>
                        @endif
                            <input class="text-base tcl mb-3" type="radio" name="reflectDescription" value="{{$os['description']}}">手順{{$os['step_number']}} : {{$os['description']}}<br>
                @endforeach
            </div>
        
</form>




</section>

</x-app-layout>