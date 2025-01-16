@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">ダッシュボード</h2>
    <div class="photo-gallery position-relative">
        @foreach ($images as $image)
            <div class="photo-item position-absolute">
                <a href="{{ route('posts.show', $image->post_id) }}">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="投稿画像">
                </a>
            </div>
        @endforeach
    </div>
</div>

<style>
    /* ギャラリー全体のスタイル */
    .photo-gallery {
        width: 100%;
        height: 70vh;
        position: relative;
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #f9f9f9;
    }

    /* 各写真のスタイル */
    .photo-item {
        width: 150px;
        height: 150px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 2px solid white;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }

    .photo-item:hover img {
        transform: scale(1.05);
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.3);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const photoItems = document.querySelectorAll('.photo-item');

        photoItems.forEach(item => {
            const randomX = Math.random() * 80 - 40; // X方向 -40% ~ +40% のランダム値
            const randomY = Math.random() * 80 - 40; // Y方向 -40% ~ +40% のランダム値
            const randomRotation = Math.random() * 30 - 15; // 回転 -15deg ~ +15deg のランダム値

            item.style.transform = `translate(${randomX}%, ${randomY}%) rotate(${randomRotation}deg)`;
            item.style.zIndex = Math.floor(Math.random() * 10); // Z軸のランダム値
        });
    });
</script>
@endsection
