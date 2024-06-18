@extends('layouts.plain')

@section('content')
<section>
<h3>【{{ $recipe['title'] }}】</h3>
<p>{{ $recipe['tags'] }}</p>
<h4>made by {{ $recipe['user']['name'] }}</h4>
<p>{{ $recipe['intro'] }}</p>

<div>
    <img src="{{ asset('storage/'. $recipe['image']) }}" alt="{{ $recipe['title'] }}">
</div>
<div>
    <p>{{ $recipe['comment'] }}</p>
    <p>{{ $recipe['ing'] }}</p>
</div>
<div>
@foreach($recipe['steps'] as $s)
    @if ($s['created_at'] == $recipe['steps'][(count($recipe['steps'])-1)]['created_at'])
        <div class="">
            <div class="">
            <p>手順{{ $s['step_number'] }}</p>
            </div>
            <p>{{ $s['description'] }}</p>
        </div>
    @endif
@endforeach
</div>



</section>


@endsection