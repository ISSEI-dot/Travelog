@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">パスワードをお忘れですか？</h2>
    <p class="form-description">
        ご登録いただいたメールアドレスを入力してください。<br>
        パスワードリセットリンクを送信します。
    </p>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例: example@example.com" required autofocus>
        </div>
        <button type="submit" class="auth-button">リセットリンクを送信</button>
    </form>
    <p class="form-footer">
        <a href="{{ route('login') }}">ログイン画面に戻る</a>
    </p>
</div>
@endsection
