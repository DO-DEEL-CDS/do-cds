<?php

namespace Database\Factories;

use App\Enums\GMBStatus;
use App\Models\GmbSubmission;
use App\Models\Roles\Admin;
use App\Models\Roles\Corper;
use Illuminate\Database\Eloquent\Factories\Factory;

class GmbSubmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GmbSubmission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => Corper::query()->inRandomOrder()->first()->id,
            'business_name' => $this->faker->company,
            'business_owner' => $this->faker->name,
            'business_email' => $this->faker->companyEmail,
            'owner_gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'status' => GMBStatus::getRandomInstance(),
            'approved_by' => Admin::first()->id,
        ];
    }
}
