@extends('layouts.default')

@section('content')

<section class="">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        @foreach($questionResults as $questionResult)
        <tr>
            <div class="q_wrapper">
                <td>
                    <div class="q_list">
                        <img class=q_img src="{{ asset('storage/' . $questionResult->image) }}" alt="">
                    </div>
                </td>
                <td>
                    <div class="q_list_content">
                        <p class="q_list_title">{{ $questionResult->title }}</p>
                        <p class="q_list_tags">{{ $questionResult->tags }}</p>
                        <p class="q_list_updated">{{ $questionResult->updated_at }}</p>
                    </div>
                </td>
            </div>
        </tr>
        @endforeach
        @foreach($articleResults as $articleResult)
        <tr>
            <div class="q_wrapper">
                <td>
                    <div class="q_list">
                        <img class=q_img src="{{ asset('storage/' . $articleResult->image) }}" alt="">
                    </div>
                </td>
                <td>
                    <div class="q_list_content">
                        <p class="q_list_title">{{ $articleResult->title }}</p>
                        <p class="q_list_tags">{{ $articleResult->tags }}</p>
                        <p class="q_list_updated">{{ $articleResult->updated_at }}</p>
                    </div>
                </td>
            </div>
        </tr>
        @endforeach
        @foreach($recipeResults as $recipeResult)
        <tr>
            <div class="q_wrapper">
                <td>
                    <div class="q_list">
                        <img class=q_img src="{{ asset('storage/' . $recipeResult->image) }}" alt="">
                    </div>
                </td>
                <td>
                    <div class="q_list_content">
                        <p class="q_list_title">{{ $recipeResult->title }}</p>
                        <p class="q_list_tags">{{ $recipeResult->tags }}</p>
                        <p class="q_list_updated">{{ $recipeResult->updated_at }}</p>
                    </div>
                </td>
            </div>
        </tr>
        @endforeach
    </div>

</section>

@endsection