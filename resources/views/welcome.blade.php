@extends('layouts.app')

@section('content')
<div class="main-container d-flex justify-content-center align-items-center">
    <div class="text-center">
        <h1 class="title">Welcome to Travelog</h1>
        <p class="subtitle">旅行記録アプリへようこそ！</p>

        @guest
        <!-- ゲストユーザーの場合、新規登録とログインボタンを表示 -->
        <div class="link-buttons mt-4">
            <a href="{{ route('register') }}" class="btn btn-primary">新規登録</a>
            <a href="{{ route('login') }}" class="btn btn-secondary">ログイン</a>
        </div>
        @else
        <!-- 認証済みユーザーの場合、ダッシュボードリンクを表示 -->
        <div class="link-buttons mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-success">ダッシュボードに進む</a>
        </div>

        <!-- ユーザー向けの機能カードを表示 -->
        <div class="row g-4 mt-5">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-plus-circle fa-3x mb-3" style="color: #4a47a3;"></i>
                        <h5 class="card-title">投稿を作成</h5>
                        <p class="card-text">旅行記録を作成しましょう！</p>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">作成する</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-list fa-3x mb-3" style="color: #f6b93b;"></i>
                        <h5 class="card-title">投稿を見る</h5>
                        <p class="card-text">旅行記録を閲覧できます！</p>
                        <a href="{{ route('posts.index') }}" class="btn btn-warning">見る</a>
                    </div>
                </div>
            </div>
        </div>
        @endguest
    </div>
</div>
@endsection
