@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4" style="color: #4a47a3;">Welcome to Travelog</h1>
    <p class="text-center mb-4">旅行記録アプリへようこそ！</p>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-plus-circle fa-3x mb-3" style="color: #4a47a3;"></i>
                    <h5 class="card-title">投稿を作成</h5>
                    <p class="card-text">新しい旅行記録を作成しましょう。</p>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">作成する</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-list fa-3x mb-3" style="color: #f6b93b;"></i>
                    <h5 class="card-title">投稿を見る</h5>
                    <p class="card-text">旅行記録を閲覧できます。</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-warning">見る</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-user-edit fa-3x mb-3" style="color: #78e08f;"></i>
                    <h5 class="card-title">プロフィール編集</h5>
                    <p class="card-text">あなたの情報を更新しましょう。</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-success">編集する</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
