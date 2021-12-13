<?php

namespace Database\Factories;

use App\Models\Employment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
                'title' => $this->faker->jobTitle,
                'description' => $this->faker->paragraph,
                'type' => $this->faker->domainWord,
                'location' => $this->faker->address,
                'closing_date' => $this->faker->dateTimeThisMonth(now()->add('+ 1month')),
                'apply_link' => $this->faker->url,
                'rate' => '',
                'perks' => $this->faker->words
        ];
    }
}
