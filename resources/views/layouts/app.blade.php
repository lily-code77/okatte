<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'OKATTE!') }}</title>

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPGothic&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Include stylesheet -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
        <!-- Include the Quill library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

        <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        
        <!-- jsMind -->
        <link type="text/css" rel="stylesheet" href="https://unpkg.com/jsmind@0.8.5/style/jsmind.css" />
        <script type="text/javascript" src="https://unpkg.com/jsmind@0.8.5/es6/jsmind.js"></script>
        <script type="text/javascript" src="https://unpkg.com/jsmind@0.8.5/es6/jsmind.draggable-node.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    </head>
    <body class="fons-sans antialiased bg-amber-100 dark:bg-gray-900">
        <div class="min-h-screen">
            <!-- ここに共通ヘッダーのコンポーネントを読み込む -->
            
            @if (Route::has('login'))
                @auth
                    @include('layouts.announce-header')
                    @include('layouts.global-header')
                @else
                    <div class="mt-3">
                        @include('layouts.global-header')
                    </div>
                @endauth
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
