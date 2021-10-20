<?php

namespace Database\Factories;

use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingAttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrainingAttendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'training_id' => Training::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
