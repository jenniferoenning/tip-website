<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Category::class;

    public function definition()
    {
        $name = $this->faker->word();
        $slug = \Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
