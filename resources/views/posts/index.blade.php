@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">投稿一覧</h1>

    @if ($posts->count() > 0)
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
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
    @else
        <p>現在、投稿はありません。</p>
    @endif
</div>
@endsection
