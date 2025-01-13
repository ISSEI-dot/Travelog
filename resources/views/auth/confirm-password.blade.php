@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">パスワード確認</h2>
    <p class="form-description">
        この操作を続けるには、パスワードを確認してください。
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
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="パスワードを入力" required autocomplete="current-password">
        </div>
        <button type="submit" class="auth-button">確認</button>
    </form>
</div>
@endsection
