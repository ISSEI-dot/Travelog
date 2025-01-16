@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center font-weight-bold mb-4">マイページ</h2>

    <div class="row g-4">
        <!-- プロフィール情報のカード -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    プロフィール情報
                </div>
                <div class="card-body text-center">
                    <p><strong>名前:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>メール:</strong> {{ auth()->user()->email }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">プロフィールを編集</a>
                </div>
            </div>
        </div>

        <!-- パスワード変更のカード -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark text-center">
                    パスワード変更
                </div>
                <div class="card-body text-center">
                    <p>セキュリティを保つため定期的に変更しましょう。</p>
                    <a href="{{ route('profile.password.edit') }}" class="btn btn-warning btn-sm">パスワードを変更</a>
                </div>
            </div>
        </div>

        <!-- アカウント削除のカード -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white text-center">
                    アカウント削除
                </div>
                <div class="card-body text-center">
                    <p>アカウントを削除する場合は注意してください。</p>
                    <a href="{{ route('profile.delete') }}" class="btn btn-danger btn-sm">アカウントを削除</a>
                </div>
            </div>
        </div>

        <!-- 関連機能のカード -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white text-center">
                    関連機能
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary me-3">新しい投稿を作成</a>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">投稿一覧を見る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
