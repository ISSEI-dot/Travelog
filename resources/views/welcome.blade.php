@extends('layouts.app')

@section('content')
<h2 class="text-center mb-4" style="color: #4a47a3; font-weight: bold;">Welcome to Travelog</h2>
<p class="text-center" style="font-size: 1.2rem;">旅行の思い出を記録して、素敵な瞬間をシェアしましょう！</p>

<div class="row mt-4">
    <!-- カード1 -->
    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-book-open fa-3x mb-3" style="color: #4a47a3;"></i>
                <h5 class="card-title">記録を作成</h5>
                <p class="card-text">あなたの旅行記録を追加しましょう。</p>
                <a href="#" class="btn btn-primary">作成する</a>
            </div>
        </div>
    </div>
    <!-- カード2 -->
    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-images fa-3x mb-3" style="color: #f6b93b;"></i>
                <h5 class="card-title">ギャラリーを見る</h5>
                <p class="card-text">旅行の写真をギャラリーで確認できます。</p>
                <a href="#" class="btn btn-warning">ギャラリー</a>
            </div>
        </div>
    </div>
    <!-- カード3 -->
    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-map-marked-alt fa-3x mb-3" style="color: #78e08f;"></i>
                <h5 class="card-title">マップをチェック</h5>
                <p class="card-text">訪れた場所を地図で確認しましょう。</p>
                <a href="#" class="btn btn-success">地図を見る</a>
            </div>
        </div>
    </div>
</div>
@endsection
