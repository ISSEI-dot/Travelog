@extends('layouts.app')

@section('content')
    @if (isset($user) && $user)
        <h2 class="text-center mb-4" style="color: #4a47a3; font-weight: bold;">{{ $user->name }}</h2>
        <p>{{ $user->email }}</p>
    @else
        <p class="text-center">ユーザー情報が見つかりません。</p>
    @endif
@endsection
