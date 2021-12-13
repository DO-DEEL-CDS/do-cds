<?php

namespace Database\Factories;

use App\Enums\Batch;
use App\Enums\StateMembershipType;
use App\Models\State;
use App\Models\StateMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StateMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'type' => StateMembershipType::getRandomInstance(),
                'state_code' => State::inRandomOrder()->first()->state_code,
                'instagram' => $this->faker->userName,
                'facebook' => $this->faker->url,
                'name' => $this->faker->name,
                'email' => $this->faker->safeEmail,
                'position' => $this->faker->title,
                'phone_number' => $this->faker->e164PhoneNumber,
                'batch' => Batch::getRandomInstance(),
                'year' => $this->faker->year,
        ];
    }
}
