<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('マイページ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("質問 / 回答 一覧") }}
                    @foreach($myQuestions as $myQuestion)
                    <tr>
                        <div class="q_wrapper">
                            <td>
                                <div class="q_list">
                                    <img class=q_img src="{{ asset('storage/' . $myQuestion->image) }}" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="q_list_content">
                                    <p class="q_list_title">{{ $myQuestion->title }}</p>
                                    <p class="q_list_tags">{{ $myQuestion->tags }}</p>
                                    <p class="q_list_updated">{{ $myQuestion->updated_at }}</p>
                                </div>
                            </td>
                        </div>
                    </tr>
                    @endforeach
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("記事一覧") }}
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("レシピ一覧") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
