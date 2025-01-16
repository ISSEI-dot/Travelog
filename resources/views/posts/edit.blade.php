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

                <!-- 更新ボタン -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100">更新する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
