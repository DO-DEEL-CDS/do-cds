<?php

namespace Database\Factories;

use App\Enums\Batch;
use App\Enums\ProjectMemberType;
use App\Models\ProjectMember;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
                'type' => ProjectMemberType::getRandomInstance(),
                'batch' => Batch::getRandomInstance(),
                'year' => $this->faker->year,
                'instagram' => $this->faker->userName,
                'phone_number' => $this->faker->e164PhoneNumber,
                'state_code' => State::query()->inRandomOrder()->first()->state_code,
                'facebook_link' => $this->faker->url,
                'position' => $this->faker->randomElement(['president', 'vice president', 'secretary']),
                'name' => $this->faker->name,
                'email' => $this->faker->email
        ];
    }
}
