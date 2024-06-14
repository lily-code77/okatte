@extends('layouts.plain')

@section('content')
<section>
<h3>【{{ $recipe['title'] }}】_手順の変更履歴一覧</h3>

<form action="" method="post">
    <button class="" type="submit">反映させる</button>
    <p>作成中のレシピに反映させたい過去の手順を一つ選んでください。</p>
        @foreach($recipe['steps'] as $i => $os)
            <div class="step">
                @if ($os['step_number'] == 1)
                    <p class="version_name">手順のタイトル=>{{$os['version_name']}}</p>
                @endif
                    <input type="radio">手順{{$os['step_number']}} : {{$os['description']}}
            </div>
        @endforeach
</form>




</section>

@endsection