@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- 投稿詳細 -->
    <div class="card shadow-lg glass-bg text-white border-0 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center p-4">
            <h2 class="mb-0">{{ $post->title }}</h2>
            <!-- 平均評価 -->
            @if ($post->reviews->count() > 0)
                @php
                    $averageRating = round($post->reviews->avg('rating'), 1);
                @endphp
                <div class="d-flex align-items-center">
                    <span class="me-2 text-lg font-semibold text-white">{{ $averageRating }}</span>
                    <div>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $averageRating)
                                <span class="text-warning text-lg">★</span>
                            @else
                                <span class="text-gray-400 text-lg">☆</span>
                            @endif
                        @endfor
                    </div>
                </div>
            @else
                <span class="text-light">評価なし</span>
            @endif
        </div>
        <div class="card-body p-4">
            <p class="text-white text-sm mb-3">作成日: {{ $post->created_at->format('Y年m月d日 H:i') }}</p>
            <p class="text-lg mb-4">{{ $post->description }}</p>

            @if($post->images)
                <div class="row mt-4 g-3">
                    @foreach($post->images as $image)
                        <div class="col-md-4">
                            <img src="{{ asset('images/' . $image->image_path) }}" class="img-fluid rounded shadow" alt="投稿画像">
                        </div>
                    @endforeach
                </div>
            @endif

            @auth
                @if (auth()->id() === $post->user_id)
                <div class="mt-4 d-flex justify-content-end">
                    <!-- 編集ボタン -->
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-light px-4 py-2 me-2">編集</a>

                    <!-- 削除ボタン -->
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4 py-2" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- レビュー投稿ボタン (地図の上に配置) -->
    <div class="text-center mb-4">
        <a href="#review-form" class="btn btn-primary">レビューを投稿する</a>
    </div>

    <!-- 地図表示 -->
    <div class="card shadow-lg glass-bg text-white border-0 mb-5">
        <div class="card-header p-4">
            <h3 class="mb-0">地図</h3>
        </div>
        <div class="card-body p-4">
            <div id="map" style="height: 400px; border-radius: 10px;"></div>
        </div>
    </div>

    <!-- レビューセクション -->
    <div class="mt-5">
        <div class="card shadow border-0 glass-bg">
            <div class="card-body p-4">
                <h3 class="mb-4 text-xl font-semibold text-white">レビュー一覧</h3>

                @if ($reviews->isNotEmpty())
                    @foreach ($reviews as $review)
                        <div class="mb-4 p-3 bg-transparent border-bottom border-gray-700">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 font-semibold text-white">{{ $review->user->name }}</p>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <span class="text-warning text-md">★</span>
                                        @else
                                            <span class="text-gray-500 text-md">☆</span>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="mt-2 text-white">{{ $review->content }}</p>
                            <small class="text-white">{{ $review->created_at->diffForHumans() }}</small>

                            @auth
                                @if (auth()->id() === $review->user_id)
                                    <form method="POST" action="{{ route('reviews.destroy', [$post->id, $review->id]) }}" class="mt-2 d-flex justify-content-end">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('このレビューを削除しますか？')">削除</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @endforeach

                    <!-- ページネーション -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <p class="text-gray-400">まだレビューがありません。</p>
                @endif
            </div>
        </div>

        <!-- レビューフォーム -->
        @auth
            <form id="review-form" method="POST" action="{{ route('reviews.store', $post->id) }}" class="mt-4 p-4 shadow glass-bg">
                @csrf
                <h4 class="text-lg font-semibold text-white mb-3">レビューを投稿する</h4>
                <div class="mb-3">
                    <label for="rating" class="form-label text-white">評価（1〜5）</label>
                    <select name="rating" id="rating" class="form-select text-gray-700" required>
                        <option value="5">★★★★★</option>
                        <option value="4">★★★★☆</option>
                        <option value="3">★★★☆☆</option>
                        <option value="2">★★☆☆☆</option>
                        <option value="1">★☆☆☆☆</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label text-white">レビュー内容</label>
                    <textarea name="content" id="content" class="form-control text-gray-700" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary d-flex justify-content-end">送信</button>
            </form>
        @else
            <p class="mt-4 text-white">レビューを投稿するには <a href="{{ route('login') }}" class="text-warning underline">ログイン</a> が必要です。</p>
        @endauth
    </div>
</div>

<!-- ガラス風デザイン -->
<style>
    .glass-bg {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 15px;
    }
</style>

<!-- Leaflet 地図スクリプト -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('map').setView([{{ $post->latitude ?? 35.6895 }}, {{ $post->longitude ?? 139.6917 }}], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
    L.marker([{{ $post->latitude ?? 35.6895 }}, {{ $post->longitude ?? 139.6917 }}]).addTo(map)
        .bindPopup('<b>{{ $post->title }}</b><br>{{ $post->description }}').openPopup();
});
</script>
@endsection
