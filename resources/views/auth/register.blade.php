@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">新規登録</h2>
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf
        <div class="form-group">
            <label for="name">名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎" required autofocus>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例: example@example.com" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="8文字以上のパスワードを入力" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">パスワード（確認）</label>
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="もう一度パスワードを入力" required>
        </div>
        <button type="submit" class="auth-button">登録する</button>
    </form>
    <p class="form-footer">
        <a href="{{ route('login') }}">既にアカウントをお持ちですか？ログインはこちら</a>
    </p>
</div>
@endsection
