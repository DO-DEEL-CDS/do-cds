<?php

namespace Database\Factories;

use App\Enums\StateMembershipType;
use App\Models\State;
use App\Models\StateMember;
use App\Models\User;
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
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
