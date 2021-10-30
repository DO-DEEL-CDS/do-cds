<?php

namespace Database\Factories;

use App\Enums\TrainingStatus;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Training::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'status' => TrainingStatus::getRandomInstance(),
            'live_video' => 'https://www.youtube.com/watch?v=x7UZyRmDO-Y',
            'start_time' => $this->faker->dateTimeThisMonth(now()->add('20 days')),
            'tutor' => $this->faker->name,
            'created_by' => User::first()->id,
            'overview' => $this->faker->paragraph
        ];
    }
}
