@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">投稿写真ギャラリー</h1>
    <div class="row g-3">
        @foreach ($posts as $post)
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $post->image_path) }}" class="card-img-top" alt="投稿画像">
                </div>
            </div>
        @endforeach
    </div>

    <!-- ページネーション -->
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection
