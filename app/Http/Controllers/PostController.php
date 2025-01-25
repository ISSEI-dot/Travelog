<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10); // 投稿を最新順で取得
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create'); // 投稿作成ビュー
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:30000', // 複数画像対応
        ]);

        // 投稿を保存
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        // 画像を保存
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $post->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('posts.index')->with('success', '投稿が作成されました！');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post')); // 投稿詳細ビュー
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post')); // 投稿編集ビュー
    }

    public function update(Request $request, Post $post)
    {

        // ログインユーザーが投稿者か確認
        if (Auth::id() !== $post->user_id) {
            abort(403, '権限がありません。');
        }

        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 複数画像対応
        ]);

        // 投稿情報の更新
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // 新しい画像を保存
        if ($request->hasFile('images')) {
            foreach ($post->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $post->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('posts.show', $post->id)->with('success', '投稿が更新されました！');
    }

    public function destroy(Post $post)
    {
        // ログインユーザーが投稿者か確認
        if (Auth::id() !== $post->user_id) {
            abort(403, '権限がありません。');
        }

        // 画像を削除
        foreach ($post->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', '投稿が削除されました！');
    }

    public function dashboard()
    {
        // 投稿画像を取得（最新順）
        $images = PostImage::inRandomOrder()->limit(30)->get();

        return view('dashboard', compact('images'));
    }

}
