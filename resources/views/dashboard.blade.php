@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h1 class="title">ダッシュボード</h1>
    <div class="photo-gallery position-relative">
        @foreach ($images as $image)
            <div class="photo-item position-absolute">
                <a href="{{ route('posts.show', $image->post_id) }}">
                    <img src="{{ asset('images/' . $image->image_path) }}" alt="投稿画像">
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
        background: lightyellow;
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
        const galleryWidth = document.querySelector('.photo-gallery').clientWidth;
        const galleryHeight = document.querySelector('.photo-gallery').clientHeight;
        const occupiedPositions = []; // 使用された位置を記録

        photoItems.forEach(item => {
            let isOverlapping = true;
            let randomX, randomY;

            while (isOverlapping) {
                randomX = Math.random() * (galleryWidth - 150); // 150pxは写真の幅
                randomY = Math.random() * (galleryHeight - 150); // 150pxは写真の高さ
                isOverlapping = occupiedPositions.some(pos => {
                    const distance = Math.sqrt(
                        Math.pow(pos.x - randomX, 2) + Math.pow(pos.y - randomY, 2)
                    );
                    return distance < 180; // 写真同士の最小間隔（ピクセル単位）
                });
            }

            occupiedPositions.push({ x: randomX, y: randomY });

            const randomRotation = Math.random() * 20 - 10; // 回転 -10deg ~ +10deg のランダム値

            item.style.transform = `translate(${randomX}px, ${randomY}px) rotate(${randomRotation}deg)`;
            item.style.zIndex = Math.floor(Math.random() * 10); // Z軸のランダム値
        });
    });
</script>
@endsection
