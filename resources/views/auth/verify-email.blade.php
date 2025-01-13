@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">メールアドレスの確認</h2>

    @if (session('status') == 'verification-link-sent')
        <p class="alert alert-success">
            新しい確認リンクが登録済みメールアドレスに送信されました。
        </p>
    @endif

    <p>続行する前に、メールアドレス確認用リンクが記載されたメールを確認してください。</p>
    <p>もしメールが届いていない場合は、以下のリンクをクリックしてください。</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="auth-button">確認メールを再送する</button>
    </form>
</div>
@endsection
