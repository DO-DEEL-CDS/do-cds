<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'state_code' => State::inRandomOrder()->first()->state_code,
            'phone_number' => $this->faker->e164PhoneNumber,
        ];
    }
}
