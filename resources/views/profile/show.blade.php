@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 rounded bg-white shadow">
    <h2 class="text-center mb-4" style="color: #4a47a3; font-weight: bold;">プロフィール</h2>

    <!-- プロフィール情報表示 -->
    @if(auth()->check()) <!-- ログイン状態を確認 -->
        <div class="mb-3">
            <label class="form-label" style="font-weight: bold;">名前</label>
            <p>{{ auth()->user()->name }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight: bold;">メールアドレス</label>
            <p>{{ auth()->user()->email }}</p>
        </div>

        <!-- 編集ボタン -->
        <div class="text-center mt-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">編集する</a>
        </div>
    @else
        <!-- 非ログイン状態の表示 -->
        <div class="alert alert-danger text-center">
            ログインしていません。<a href="{{ route('login') }}">ログイン</a>してください。
        </div>
    @endif
</div>
@endsection
