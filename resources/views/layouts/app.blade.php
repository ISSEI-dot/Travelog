<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travelog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.header') <!-- ヘッダーを追加 -->
    <div class="container my-5">
        @yield('content')
    </div>
    @include('layouts.footer') <!-- フッターを追加 -->
</body>
</html>
