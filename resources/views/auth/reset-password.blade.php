@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">パスワードリセット</h2>
    <p class="form-description">
        新しいパスワードを入力してリセットしてください。
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

    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" placeholder="例: example@example.com" required autofocus>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">新しいパスワード</label>
            <input id="password" type="password" name="password" placeholder="新しいパスワードを入力" required>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">新しいパスワード（確認用）</label>
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="もう一度新しいパスワードを入力" required>
        </div>

        <button type="submit" class="auth-button">パスワードをリセット</button>
    </form>
</div>
@endsection
