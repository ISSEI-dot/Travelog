@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">パスワードを忘れた場合</h2>

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" placeholder="例: example@example.com" required autofocus>
        </div>
        <button type="submit" class="auth-button">リセットリンクを送信</button>
    </form>
</div>
@endsection
