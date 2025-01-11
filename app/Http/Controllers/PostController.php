<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
        // 投稿保存処理
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // 画像は任意
            'location' => 'nullable|string|max:255',
        ]);
    
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->location = $request->location;
        $post->user_id = auth()->id();
    
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public'); // publicディスクに保存
        }
    
        $post->save();
    
        return redirect()->route('posts.index')->with('success', '投稿を作成しました。');
    }

    public function show(Post $post)
    {
        return view('posts.show',compact('post')); // 投稿詳細ビュー
    }

    public function edit(Post $post)
    {
        return view('posts.edit',compact('post')); // 投稿編集ビュー
    }

    public function update(Request $request, Post $post)
    {
        // 投稿更新処理
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'location' => 'nullable|string|max:255',
        ]);
    
        $post->title = $request->title;
        $post->description = $request->description;
        $post->location = $request->location;
    
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }
    
        $post->save();
    
        return redirect()->route('posts.index')->with('success', '投稿を更新しました。');
    }

    public function destroy(Post $post)
    {
        // 投稿削除処理
        $post->delete();

    return redirect()->route('posts.index')->with('success', '投稿を削除しました。');
    }
}
