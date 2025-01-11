<nav x-data="{ open: false }" class="bg-light border-b border-gray-100 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="container d-flex justify-content-between align-items-center py-3">
        <!-- Logo -->
        <a href="/" class="navbar-brand d-flex align-items-center">
            <i class="fas fa-suitcase-rolling me-2" style="font-size: 2rem; color: #4a47a3;"></i>
            <span style="color: #4a47a3; font-weight: bold; font-size: 1.8rem;">Travelog</span>
        </a>

        <!-- Navigation Links -->
        <div class="d-flex align-items-center">
            <a href="{{ route('profile') }}" class="nav-link text-dark">
                <i class="fas fa-user-circle me-1"></i> プロフィール
            </a>

            <form method="POST" action="{{ route('logout') }}" class="ms-3">
                @csrf
                <button type="submit" class="btn btn-link text-dark" style="text-decoration: none;">
                    <i class="fas fa-sign-out-alt me-1"></i> ログアウト
                </button>
            </form>
        </div>
    </div>
</nav>
