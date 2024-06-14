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

    <script src="/js/recipe/create.js"></script>
    
</head>
<body>

<!-- ▼▼▼▼共通ヘッダー▼▼▼▼　-->
<header>
    <div class="">
        <ul class="top">
            <li><a class="" href="/"><img class="logo_top" src="{{ asset('images/index/logo.png') }}" alt="ロゴ"></a></li>
        </ul>
    </div>
</header>
<!-- ▲▲▲▲共通ヘッダー▲▲▲▲　-->

<!-- ▼▼▼▼ページ毎の個別内容▼▼▼▼　-->
<main>
@yield('content')
</main>
<!-- ▲▲▲▲ページ毎の個別内容▲▲▲▲　-->
</body>
</html>