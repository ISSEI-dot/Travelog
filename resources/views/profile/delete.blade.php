@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center">アカウントの削除</h2>
    <p class="text-center text-danger">本当に削除してよろしいですか？この操作は取り消せません。</p>
    <form method="POST" action="{{ route('profile.delete') }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger d-block mx-auto">削除する</button>
    </form>
</div>
@endsection
