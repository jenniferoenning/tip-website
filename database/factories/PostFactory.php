<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->paragraph(2),
            'description' => $this->faker->paragraph(2),
            'user_id' => User::factory(),
            'category_id' => Category::all()->random()->id,
            //'post_photo_path' => $this->faker->imageUrl(),
            // 'url_image' =>
            'sentiment_score' => $this->faker->numberBetween(0, 1) . '.' . $this->faker->randomNumber(4, true)
        ];
    }
}
