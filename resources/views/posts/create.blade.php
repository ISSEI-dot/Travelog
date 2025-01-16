@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">投稿を作成</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- タイトル -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">タイトル</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <!-- 内容 -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">内容</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                        </div>

                        <!-- メイン画像 -->
                        <div class="mb-4">
                            <label for="images" class="form-label fw-bold">画像</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple required>
                        </div>

                        <!-- 投稿ボタン -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg w-100">投稿する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
