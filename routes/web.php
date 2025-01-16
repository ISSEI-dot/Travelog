<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

// ホームページ
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 会社情報
Route::get('/company-info', [CompanyController::class, 'index'])->name('company.info');

// 認証が必要なルートをグループ化
Route::middleware(['auth'])->group(function () {
    // ダッシュボード
    Route::get('/dashboard', [PostController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

    // プロフィール関連
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); // マイページ（トップ）
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // プロフィール情報更新
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // プロフィール情報更新処理
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit'); // パスワード変更
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update'); // パスワード変更処理
    Route::get('/profile/delete', [ProfileController::class, 'confirmDelete'])->name('profile.delete.confirm'); // アカウント削除確認
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete'); // アカウント削除処理

    // 投稿関連のリソースルート
    Route::resource('posts', PostController::class);
});

// 認証関連のルート
require __DIR__ . '/auth.php';
