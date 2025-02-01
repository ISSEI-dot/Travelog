@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="title">投稿一覧</h1>
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if ($post->images->count() > 0)
                <img src="{{ asset('images/' . $post->images->first()->image_path) }}" class="card-img-top" alt="投稿画像">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                    
                    <!-- 平均評価を表示 -->
                    @if ($post->averageRating > 0)
                        <div class="mb-2">
                            <span class="text-warning fw-bold">{{ $post->averageRating }}</span>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $post->averageRating)
                                    <span class="text-warning">★</span>
                                @else
                                    <span class="text-secondary">☆</span>
                                @endif
                            @endfor
                        </div>
                    @else
                        <p class="text-muted">評価なし</p>
                    @endif

                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $posts->links() }} <!-- ページネーション -->
</div>
@endsection
