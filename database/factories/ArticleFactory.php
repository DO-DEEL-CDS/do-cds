<?php

namespace Database\Factories;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'author' => User::inRandomOrder()->first()->id,
            'status' => ArticleStatus::getRandomValue()
        ];
    }
}
