<section class="bg-white tcl">
    <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('/images/index/logo.png') }}" alt="logo" class="w-25 h-7 m-2">
        </a>
        <form class="mb-3 w-full lg:w-auto flex justify-center lg:justify-start" action="{{ route('search.find') }}" method="GET">
            @csrf
            <input type="text" id="search" name="keyword" class="border border-gray-300 rounded-lg px-3 py-2.5 ml-7 focus:outline-none focus:ring-4 focus:ring-blue-500/50" placeholder="全ての記事/レシピから検索">
            <button type="submit" class="focus:outline-none button focus:ring-blue-500/50 font-medium rounded text-sm px-5 py-2.5 ml-2">検索</button>
        </form>
        <div class="mb-3 flex flex-col lg:flex-row items-center w-full lg:w-auto justify-center lg:justify-start space-y-2 lg:space-y-0 lg:space-x-2">
            <a href="{{ route('recipe.create') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">レシピを作成</a>
            <a href="{{ route('article.create') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5">記事を作成</a>
            <a href="{{ route('bookmarks.index') }}" class="focus:outline-none button font-medium rounded text-sm px-5 py-2.5" target="_blank">ブックマーク</a>
        </div>
        <div class="mb-3 flex flex-col lg:flex-row items-center w-full lg:w-auto justify-center lg:justify-start space-y-2 lg:space-y-0 lg:space-x-2">
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

    <script>
        document.getElementById('search').addEventListener('input', function() {
            let query = this.value;
            fetch(`/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    let results = document.getElementById('results');
                    results.innerHTML = '';
                    data.forEach(item => {
                        let div = document.createElement('div');
                        div.textContent = item.name; // 適切なプロパティを使用してください
                        results.appendChild(div);
                    });
                });
        });
    </script>
</section>
