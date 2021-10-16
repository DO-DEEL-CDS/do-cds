<?php

namespace Database\Factories;

use App\Models\Prospect;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProspectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prospect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'nysc_state_code' => State::query()->inRandomOrder()->first()->state_code . '/21A/' . mt_rand(1000, 9999),
        ];
    }
}
