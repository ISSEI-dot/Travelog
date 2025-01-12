@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">ログイン</h2>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例: example@example.com" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="パスワードを入力" required>
        </div>
        <div class="form-group form-checkbox">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">ログイン情報を記憶する</label>
        </div>
        <button type="submit" class="auth-button">ログイン</button>
    </form>
    <p class="form-footer">
        <a href="{{ route('password.request') }}">パスワードを忘れた場合はこちら</a>
        <br>
        <a href="{{ route('register') }}">アカウントをお持ちでない場合はこちら</a>
    </p>
</div>
@endsection
