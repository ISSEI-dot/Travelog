@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">パスワードリセット</h2>

    <form method="POST" action="{{ route('password.update') }}" class="auth-form">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required>
        </div>
        <div class="form-group">
            <label for="password">新しいパスワード</label>
            <input id="password" type="password" name="password" placeholder="新しいパスワードを入力" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">パスワード（確認）</label>
            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="もう一度入力" required>
        </div>
        <button type="submit" class="auth-button">パスワードをリセットする</button>
    </form>
</div>
@endsection
