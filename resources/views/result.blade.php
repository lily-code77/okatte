<x-app-layout>
<section class="container m-8">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        @foreach($articleResults as $articleResult)
            <div class="container m-8 bg-white rounded-lg shadow">
                <a class="m-1" href="{{ route('article.show', ['article' => $articleResult->id]) }}">
                    <div class="flex">
                        <img class="mx-3 w-48" src="{{ asset('storage/' . $articleResult->image) }}" alt="">
                        <div class="ml-5 leading-relaxed">
                            <p class="text-base tcl">@ {{ $articleResult['user']['name'] }}</p>
                            <p class="text-2xl font-bold text-pretty tcl">{{ $articleResult->title }}</p>
                            <p class="text-base text-slate-500">{{ $articleResult->tags }}</p>
                            <p class="text-xs text-slate-400">{{ $articleResult->updated_at }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        @foreach($recipeResults as $recipeResult)
            <div class="q_wrapper">
                <div class="q_list">
                    <img class=q_img src="{{ asset('storage/' . $recipeResult->image) }}" alt="">
                </div>
                <div class="q_list_content">
                    <p class="q_list_title">{{ $recipeResult->title }}</p>
                    <p class="q_list_tags">{{ $recipeResult->tags }}</p>
                    <p class="q_list_updated">{{ $recipeResult->updated_at }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
</x-app-layout>