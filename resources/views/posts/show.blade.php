@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">{{ $post->title }}</h2>
        </div>
        <div class="card-body">
            <p class="text-muted">作成日: {{ $post->created_at->format('Y年m月d日 H:i') }}</p>
            <p>{{ $post->description }}</p>

            @if($post->images)
                <div class="row mt-4">
                    @foreach($post->images as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded" alt="投稿画像">
                        </div>
                    @endforeach
                </div>
            @endif

            @auth
                @if (auth()->id() === $post->user_id)
                <div class="mt-4 d-flex justify-content-between">
                    <!-- 編集ボタン -->
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">編集</a>

                    <!-- 削除ボタン -->
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection
