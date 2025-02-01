@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">投稿を編集</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- タイトル -->
                <div class="mb-4">
                    <label for="title" class="form-label fw-bold">タイトル</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
                </div>

                <!-- 内容 -->
                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">内容</label>
                    <textarea name="description" id="description" class="form-control" rows="5" required>{{ $post->description }}</textarea>
                </div>

                <!-- 画像の変更 -->
                <div class="mb-4">
                    <label for="images" class="form-label fw-bold">画像を変更</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                </div>

                <!-- 観光地検索 -->
                <div class="mb-4">
                    <label for="location" class="form-label fw-bold">観光地名または住所</label>
                    <input type="text" id="location" class="form-control" placeholder="例: 東京タワー" value="{{ $post->location }}">
                    <small class="text-muted">観光地名または住所を入力して検索できます。</small>
                </div>

                <!-- 地図表示 -->
                <div id="map" style="height: 300px;"></div>

                <!-- 緯度・経度を隠しフィールドで送信 -->
                <input type="hidden" id="latitude" name="latitude" value="{{ $post->latitude }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ $post->longitude }}">

                <!-- 更新ボタン -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100">更新する</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Leaflet & OpenStreetMap -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let latitude = {{ $post->latitude ?? 35.6895 }}; // デフォルトで東京の緯度
        let longitude = {{ $post->longitude ?? 139.6917 }}; // デフォルトで東京の経度

        let map = L.map('map').setView([latitude, longitude], 14);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);

        // マーカーのドラッグイベント
        marker.on('dragend', function (event) {
            let position = event.target.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
        });

        // OpenStreetMap API を使って観光地 & 住所検索
        document.getElementById('location').addEventListener('change', function () {
            let query = document.getElementById('location').value;
            if (!query) return;

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        let lat = data[0].lat;
                        let lon = data[0].lon;

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lon;

                        map.setView([lat, lon], 14);
                        marker.setLatLng([lat, lon]);
                    } else {
                        alert("検索結果が見つかりませんでした。");
                    }
                })
                .catch(error => console.error("エラー:", error));
        });
    });
</script>

@endsection
