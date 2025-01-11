<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return view('profile.show', compact('user'));
        } else {
        return redirect()->route('login')->with('error', 'ログインしてください。');
        }
    }


    // マイページを表示
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    // 会員情報を更新
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email'));

        return redirect()->route('profile.edit')->with('status', 'プロフィールを更新しました！');
    }

    // 退会処理
    public function destroy(Request $request)
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();

        return redirect('/')->with('status', 'アカウントを削除しました。');
    }
}
