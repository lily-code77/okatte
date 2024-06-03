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
</head>
<body>

<!-- ▼▼▼▼共通ヘッダー▼▼▼▼　-->
<header>
    <div class="">
        <ul class="top">
            <li><a class="" href="/"><img class="logo_top" src="{{ asset('images/index/logo.png') }}" alt="ロゴ"></a></li>
            <li>
                <label for="search"><img id="searchImg" src="{{ asset('images/index/search.svg') }}" alt=""></label>
                <input type="text" name="search" id="search" placeholder="         全ての記事/レシピから検索">
            </li>
            <li class="headerbtn" id="question"><a href="/questions"><button class="btn" type="button" name="question">質問 / 回答</button></a></li>
            <li class="headerbtn" id="post"><a href="/postSelection"><button class="btn" type="button" name="post">投稿する</button></a></li>
                @if (Route::has('login'))
                    @auth
                    <li class="headerbtn"><a href="{{ url('/dashboard') }}" class=""><button class="btn" type="button" name="login">マイページ</button></a></li>
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
<footer class="">
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
</footer>
<!-- ▲▲▲▲共通フッター▲▲▲▲　-->
</body>
</html>