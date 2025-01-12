@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">メールアドレスの確認</h2>
    <p class="form-description">
        登録ありがとうございます！メールアドレスの確認が完了していません。確認用リンクをメールで送信しました。メールをご確認のうえ、リンクをクリックしてください。
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="success-message">
            <p>
                新しい確認リンクが登録されたメールアドレスに送信されました。
            </p>
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="auth-form">
        @csrf
        <button type="submit" class="auth-button">確認メールを再送信</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="logout-form mt-4">
        @csrf
        <button type="submit" class="logout-button">
            ログアウト
        </button>
    </form>
</div>
@endsection
