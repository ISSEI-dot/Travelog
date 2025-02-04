<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelog</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Leaflet Geocoder CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <!-- カスタムCSS -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Leaflet Geocoder JS -->
    <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>

</head>

<body>

    <!-- ✅ ハンバーガーメニュー対応ヘッダー -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <!-- ロゴ -->
            <a class="navbar-brand fw-bold fs-3" href="{{ url('/') }}">
                <i class="fas fa-suitcase-rolling me-2"></i> Travelog
            </a>

            <!-- ハンバーガーメニューのトグルボタン -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="ナビゲーションの切り替え">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- ナビゲーションメニュー -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('profile.show') }}">マイページ</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button class="nav-link btn btn-link text-white" type="submit" style="text-decoration: none;">ログアウト</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">ログイン</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('company.info') }}">会社情報</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ✅ メインコンテンツ -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- ✅ フッター -->
    <footer class="footer text-center py-3">
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

    <style>
        /* ✅ ヘッダーのスタイル */
        .navbar {
            background: rgba(0, 0, 0, 0.8); /* 透明感のある黒背景 */
        }

        .navbar-brand {
            color: white;
        }

        .navbar-toggler {
            border: none;
            outline: none;
        }

        .navbar-nav .nav-link {
            font-size: 1.2rem;
            padding: 10px;
        }
    </style>

</body>
</html>
