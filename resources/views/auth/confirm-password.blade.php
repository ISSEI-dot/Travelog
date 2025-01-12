@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">パスワード確認</h2>
    <p class="form-description">
        アプリケーションの安全なエリアにアクセスするために、パスワードを確認してください。
    </p>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
        @csrf

        <!-- Password -->
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="パスワードを入力" required autofocus>
        </div>

        <button type="submit" class="auth-button">確認する</button>
    </form>
    <p class="form-footer">
        <a href="{{ route('login') }}">ログイン画面に戻る</a>
    </p>
</div>
@endsection
