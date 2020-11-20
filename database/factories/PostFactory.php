<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1,6),
            'user_id' => rand(1,3),
            'title' => $this->faker->text(40),
            'content' => $this->faker->text(100),
            'status' => rand(0,1)
        ];
    }
}
