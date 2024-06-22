<section class="bg-white tcl">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('/images/index/logo.png') }}" alt="logo" class="w-25 h-7 m-2 pl-7">
        </a>
        <form class="mb-3" action="{{ route('search.find') }}" method="GET">
            @csrf
            <input type="text" name="keyword" class="border border-gray-300 rounded-lg px-3 py-2.5 ml-2 focus:outline-none focus:ring-4 focus:ring-blue-500/50" placeholder="全ての記事/レシピから検索">
            <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-5 py-2.5 ml-2">検索</button>
        </form>
        <div class="mb-3">
            <a href="{{ route('recipe.create') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">レシピを作成</a>
            <a href="{{ route('article.create') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">記事を作成</a>
            <a href="{{ route('bookmarks.index') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">ブックマーク</a>
        </div>
        <div class="mb-3">
            @if (Route::has('login'))
                @auth
                <a href="{{ url('/myPage') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">マイページ</a>
                @else
                <a href="{{ route('login') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">ログイン</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">新規登録</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

</section>