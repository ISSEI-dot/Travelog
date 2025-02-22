@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg glass-bg text-white border-0 mb-5">
        <div class="card-header p-4">
            <h2 class="mb-0">新しい投稿を作成</h2>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- タイトル -->
                <div class="mb-4">
                    <label for="title" class="form-label text-white fw-bold">タイトル</label>
                    <input type="text" name="title" id="title" class="form-control text-dark" required>
                </div>

                <!-- 内容 -->
                <div class="mb-4">
                    <label for="description" class="form-label text-white fw-bold">内容</label>
                    <textarea name="description" id="description" class="form-control text-dark" rows="5" required></textarea>
                </div>

                <!-- 画像アップロード -->
                <div class="mb-4">
                    <label for="images" class="form-label text-white fw-bold">画像をアップロード</label>
                    <input type="file" name="images[]" id="images" class="form-control text-dark" multiple required>
                    <small class="text-light">※複数の画像を選択できます</small>
                </div>

                <!-- 観光地検索ボックス -->
                <div class="mb-4 d-flex">
                    <input type="text" id="location-search" class="form-control text-dark me-2" placeholder="例: 東京タワー, 京都, 大阪城">
                    <button type="button" id="search-btn" class="btn btn-primary">検索</button>
                </div>

                <!-- 地図 -->
                <div class="mb-4">
                    <label class="form-label text-white fw-bold">場所を指定</label>
                    <div id="map" style="height: 400px; width: 100%; border-radius: 10px;"></div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                </div>

                <!-- 投稿ボタン -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100">投稿する</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Leaflet のスタイルとスクリプト -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- 画像圧縮用のスクリプト -->
<script src="https://cdn.jsdelivr.net/npm/browser-image-compression@1.0.15/dist/browser-image-compression.js"></script>

<!-- 地図スクリプト -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log("地図スクリプトが読み込まれました！");

    var map = L.map('map').setView([35.6895, 139.6917], 12); // 東京をデフォルト位置に設定

    // 🌍 **オープンストリートマップ（最初の地図デザイン）**
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // 🔍 **検索ボタンの処理**
    document.getElementById('search-btn').addEventListener('click', function () {
        var query = document.getElementById('location-search').value;
        if (query.trim() === "") {
            alert('観光地名または住所を入力してください！');
            return;
        }
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    var latlng = [data[0].lat, data[0].lon];
                    updateMap(latlng, data[0].display_name);
                } else {
                    alert('該当する場所が見つかりませんでした。');
                }
            });
    });

    // 📌 **地図クリックでピンを追加**
    map.on('click', function (e) {
        updateMap([e.latlng.lat, e.latlng.lng], "選択した場所");
    });

    // 📍 **マップのピンを更新する関数**
    function updateMap(latlng, name) {
        map.setView(latlng, 14);
        if (marker) {
            map.removeLayer(marker);
        }
        document.getElementById('latitude').value = latlng[0];
        document.getElementById('longitude').value = latlng[1];
        marker = L.marker(latlng).addTo(map).bindPopup(name).openPopup();
    }

    // 画像圧縮の処理
    document.getElementById('images').addEventListener('change', async function (event) {
        const files = event.target.files;
        const compressedFiles = [];

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const options = {
                maxSizeMB: 1,
                maxWidthOrHeight: 1024,
                useWebWorker: true
            };
            try {
                const compressedFile = await imageCompression(file, options);
                compressedFiles.push(compressedFile);
            } catch (error) {
                console.error('画像の圧縮に失敗しました:', error);
            }
        }

        // 圧縮された画像をフォームデータに追加
        const dataTransfer = new DataTransfer();
        compressedFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('images').files = dataTransfer.files;
    });
});
</script>

<style>
    /* 🎨 **ガラス風デザイン** */
    .glass-bg {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 15px;
    }

    /* 🌍 **検索ボックスのスタイル** */
    #location-search {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 5px;
        padding: 10px;
    }

    /* ✨ **検索ボタンのスタイル** */
    #search-btn {
        border-radius: 5px;
        padding: 10px 15px;
        font-weight: bold;
    }
</style>
@endsection