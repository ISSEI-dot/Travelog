<!-- ヘッダー -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- タイトルとアイコン -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="fas fa-suitcase-rolling me-2" style="font-size: 2rem; color: #4a47a3;"></i>
            <span style="color: #4a47a3; font-weight: bold; font-size: 1.8rem;">Travelog</span>
        </a>

        <!-- ナビゲーションメニュー -->
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('profile') }}">
                        <i class="fas fa-user-circle me-1"></i> プロフィール
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-dark" style="text-decoration: none;">
                            <i class="fas fa-sign-out-alt me-1"></i> ログアウト
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
