<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Travelog</title>

    <!-- フォントとスタイル -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/travel_journal.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);">

<!-- ヘッダー -->
@include('layouts.header')

<!-- メインコンテンツ -->
<div class="container mt-5 p-4 rounded bg-white shadow">
    @yield('content')
</div>

<!-- フッター -->
@include('layouts.footer')

</body>
</html>
