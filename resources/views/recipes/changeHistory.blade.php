@extends('layouts.plain')

@section('content')
<section>
<h3>【{{ $recipe['title'] }}】_手順の変更履歴一覧</h3>

@foreach($recipe['steps'] as $i => $os)
        <div class="step">
            @if ($os['step_number'] == 1)
                <p class="version_name">手順のタイトル=>{{$os['version_name']}}</p>
            @endif
                <p class="step-number">手順{{$os['step_number']}} : {{$os['description']}}</p>
        </div>
@endforeach


</section>

@endsection