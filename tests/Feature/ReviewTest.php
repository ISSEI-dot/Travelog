<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    protected $user; // ユーザー用プロパティ
    protected $post; // 投稿用プロパティ

    /**
     * テスト用データのセットアップ。
     */
    protected function setUp(): void
    {
        parent::setUp();

        // ユーザーと投稿を作成
        $this->user = User::factory()->create();
        $this->post = Post::factory()->create(['user_id' => $this->user->id]);

        // ログイン状態に設定
        $this->actingAs($this->user);
    }

    /**
     * レビューが投稿できるかをテスト。
     */
    public function test_review_can_be_posted()
    {
        $response = $this->post(route('reviews.store', $this->post->id), [
            'content' => '素晴らしい場所でした！',
            'rating' => 5,
        ]);

        $response->assertRedirect(route('posts.show', $this->post->id));
        $this->assertDatabaseHas('reviews', [
            'content' => '素晴らしい場所でした！',
            'rating' => 5,
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);
    }

    /**
     * 無効なレビューの投稿が失敗するかをテスト。
     */
    public function test_review_validation_fails_with_invalid_input()
    {
        $response = $this->post(route('reviews.store', $this->post->id), [
            'content' => '', // 無効なデータ
            'rating' => 6,   // 範囲外の評価
        ]);

        $response->assertSessionHasErrors(['content', 'rating']);
    }

    /**
     * レビューが削除できるかをテスト。
     */
    public function test_review_can_be_deleted()
    {
        $review = Review::factory()->create([
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);

        $response = $this->delete(route('reviews.destroy', [$this->post->id, $review->id]));

        $response->assertRedirect(route('posts.show', $this->post->id));
        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
    }
}
