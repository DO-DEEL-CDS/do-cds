<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Roles\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => 'Hello World',
            'content' => 'Must Be Sorted Now',
            'author_id' => Admin::firstOrFail()->id
        ];
    }
}
