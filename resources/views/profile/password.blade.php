@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center">パスワードの変更</h2>
    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="current_password" class="form-label">現在のパスワード</label>
            <input type="password" id="current_password" name="current_password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">新しいパスワード</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">新しいパスワードの確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning">変更する</button>
    </form>
</div>
@endsection
