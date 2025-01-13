<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelog</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- カスタムCSS -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <header class="header">
        <a href="{{ url('/') }}" class="header-title">Travelog</a>
        @auth
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{ route('logout') }}" class="btn btn-outline-light me-2"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <a href="{{ route('company.info') }}" class="btn btn-outline-light">会社情報</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endauth
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="footer">
        Travelog © 2025 - 旅行記録アプリ
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 背景画像ランダム表示スクリプト -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = [
                '{{ asset("images/kyoto.jpg") }}',
                '{{ asset("images/tokyo.jpg") }}',
                '{{ asset("images/osaka.jpg") }}'
            ];
            const randomImage = images[Math.floor(Math.random() * images.length)];
            document.body.style.backgroundImage = `url(${randomImage})`;
        });
    </script>
</body>
</html>
