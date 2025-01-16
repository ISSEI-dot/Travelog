<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * マイページのトップを表示
     */
    public function show()
    {
        return view('profile.show');
    }

    /**
     * プロフィール情報の更新ページを表示
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * プロフィール情報を更新
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show')->with('success', 'プロフィール情報を更新しました！');
    }

    /**
     * パスワード変更ページを表示
     */
    public function editPassword()
    {
        return view('profile.password');
    }

    /**
     * パスワードを更新
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('profile.show')->with('success', 'パスワードを変更しました！');
    }

    /**
     * アカウント削除確認ページを表示
     */
    public function confirmDelete()
    {
        return view('profile.delete');
    }

    /**
     * アカウントを削除
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'アカウントを削除しました。');
    }
}
