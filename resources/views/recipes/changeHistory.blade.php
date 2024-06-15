@extends('layouts.plain')

@section('content')
<section>
<h3>【{{ $recipe['title'] }}】_手順の変更履歴一覧</h3>

<form action="{{ route('recipe.reflectHistory',  ['recipe' => $recipe['id'], 'step' => $step]) }}" method="post">
@csrf    
<button class="reflect" type="submit">反映させる</button>
    <p>作成中のレシピに反映させたい過去の手順を一つ選んでください。</p>
        @foreach($recipe['steps'] as $i => $os)
                @if ($os['step_number'] == 1)
                    <p class="version_name">手順のタイトル=>{{$os['version_name']}}</p>
                @endif
                    <input type="radio" name="reflectHistory" value="{{$os['description']}}">手順{{$os['step_number']}} : {{$os['description']}}<br>

        @endforeach
</form>




</section>


@endsection