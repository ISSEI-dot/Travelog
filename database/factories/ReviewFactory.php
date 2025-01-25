<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence,
            'rating' => $this->faker->numberBetween(1, 5),
            'post_id' => Post::factory(), // 関連するPostも生成
            'user_id' => User::factory(), // 関連するUserも生成
        ];
    }
}
