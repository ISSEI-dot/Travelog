<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{

    /**
     * プロフィール情報
     */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * プロフィール情報更新
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        return redirect()->route('profile.edit')->with('status', 'プロフィールを更新しました！');
    }

    /**
     * プロフィールを削除
     */
    public function destroy(Request $request)
    {
        // パスワード確認
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $user->delete();

        // ログアウトとセッションリセット
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'アカウントを削除しました。');
    }

    /**
     * プロフィール表示
     */
    public function show()
    {
        return view('profile.show');
    }

    public function logout(Request $request)
{
    Auth::logout(); // ログアウト処理

    $request->session()->invalidate(); // セッションを無効化
    $request->session()->regenerateToken(); // CSRFトークン再生成

    return redirect('/login'); // ログインページにリダイレクト
}
}
