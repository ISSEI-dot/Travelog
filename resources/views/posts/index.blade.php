@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="title">投稿一覧</h1>
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if ($post->images->count() > 0)
                <img src="{{ asset('storage/' . $post->images->first()->image_path) }}" class="card-img-top" alt="投稿画像">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $posts->links() }} <!-- ページネーション -->
</div>
@endsection
