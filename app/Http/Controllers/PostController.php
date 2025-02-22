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
        // ページネーションで投稿を取得
        $posts = Post::with('reviews')->latest()->paginate(10);

        // 平均評価を計算
        $posts->getCollection()->transform(function ($post) {
            $post->averageRating = round($post->reviews->avg('rating'), 1) ?? 0;
            return $post;
        });

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
            'location' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:30000', // 複数画像対応
        ]);

        // 投稿を保存
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location, 
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'user_id' => Auth::id(),
        ]);

        // 画像を保存
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('', 'public');
                $post->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('posts.index')->with('success', '投稿が作成されました！');
    }

    public function show(Post $post)
    {
    // レビューを最新順で取得し、5件ごとにページネーション
    $reviews = $post->reviews()->latest()->paginate(5);

    // ビューに投稿とレビューを渡す
    return view('posts.show', compact('post', 'reviews'));
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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 複数画像対応
        ]);

        // 投稿情報の更新
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
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
