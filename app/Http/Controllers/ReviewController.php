<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5', // 1~5の範囲で評価を許可
        ]);

        $post->reviews()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'rating' => $request->input('rating'), 
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'レビューを投稿しました！');
    }

    public function destroy($postId, $reviewId)
{
    $review = Review::findOrFail($reviewId);

    // ログインユーザーがレビュー投稿者か確認
    if (auth()->id() !== $review->user_id) {
        abort(403, '権限がありません。');
    }

    $review->delete();

    return redirect()->route('posts.show', $postId)->with('success', 'レビューを削除しました。');
}

}
