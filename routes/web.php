<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ホームページ
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 認証が必要なルートをグループ化
Route::middleware(['auth'])->group(function () {
    // プロフィール関連
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); // プロフィール表示
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // プロフィール編集
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // プロフィール更新
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // 退会機能
});

Route::resource('posts', PostController::class);


// 認証関連のルート
require __DIR__ . '/auth.php';
