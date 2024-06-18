@extends('layouts.plain')

@section('content')
<section>
<h3>【{{ $article['title'] }}】</h3>
<p>{{ $article['tags'] }}</p>
<h4>made by {{ $article['user']['name'] }}</h4>

<div>
    <img src="{{ asset('storage/'. $article['image']) }}" alt="{{ $article['title'] }}">
</div>
<div>
    <p>{!! $article['content'] !!}</p>
</div>

</section>


@endsection