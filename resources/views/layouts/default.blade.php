<!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title', 'OKATTE！')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Include stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPGothic&display=swap" rel="stylesheet">

    <!-- TailwindCSS -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="/js/recipe/create.js"></script>
    
</head>
<body>

<!-- ▼▼▼▼共通ヘッダー▼▼▼▼　-->
<header>
    <div class="">
        <ul class="top">
            <li><a class="" href="/"><img class="logo_top" src="{{ asset('images/index/logo.png') }}" alt="ロゴ"></a></li>
            <li>
                <form action="{{ route('search.find') }}" method="GET">
                    @csrf
                    <label for="search"><img id="searchImg" src="{{ asset('images/index/search.svg') }}" alt=""></label>
                    <input type="text" name="keyword" id="search" placeholder="         全ての記事/レシピから検索">
                    <button>検索する</button>
                </form>
            </li>
            <li class="headerbtn" id="post"><a href="/postSelection"><button class="btn" type="button" name="post">投稿する</button></a></li>
                @if (Route::has('login'))
                    @auth
                    <li class="headerbtn"><a href="{{ url('/myPage') }}" class=""><button class="btn" type="button" name="login">マイページ</button></a></li>
                    @else
                    <li class="headerbtn"><a href="{{ route('login') }}" class=""><button class="btn" type="button" name="login">ログイン</button></a></li>
                        @if (Route::has('register'))
                        <li class="headerbtn"><a href="{{ route('register') }}" class=""><button class="btn" type="button" name="register">新規登録</button></a></li>
                        @endif
                    @endauth
                @endif
        </ul>
    </div>
</header>
<!-- ▲▲▲▲共通ヘッダー▲▲▲▲　-->

<!-- ▼▼▼▼ページ毎の個別内容▼▼▼▼　-->
<main>
@yield('content')
</main>
<!-- ▲▲▲▲ページ毎の個別内容▲▲▲▲　-->

<!-- ▼▼▼▼共通フッター▼▼▼▼　-->
<!-- <footer class="">
    <div class="">
        <a class="" href="/"><img class="logo_bottom" src="{{ asset('images/index/logo.png') }}" alt="ロゴ"></a>
        <div class="address">
            <p>〒123-4567</p>
            <p>東京都墨田区押上1-2-3 Illuminateビル9F</p>
        </div>

        <ul class="bottom">
            <li><a href="/contact" class="">お問い合わせ</a></li>
            <li><a href="#" class="">Content Policy</a></li>
            <li><a href="#" class="">Privacy Policy</a></li>
            <li><a href="#" class="">User Agreement</a></li>
        </ul>
    </div>
</footer> -->
<!-- ▲▲▲▲共通フッター▲▲▲▲　-->
</body>
</html>