<?php

namespace Database\Seeders;

use App\Enums\ProjectType;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Project::factory()
            ->state([
                'type' => ProjectType::gmb(),
                'title' => 'Google My Business'
            ])
            ->hasResources(5)
            ->hasBusinesses(100)
            ->hasExcos(20)
            ->create();

        Project::factory()
            ->state([
                'type' => ProjectType::hackathon(),
                'title' => 'Hackathon'
            ])
            ->hasResources(5)
            ->hasExcos(20)
            ->create();

        Project::factory()
            ->state([
                'type' => ProjectType::mentorship(),
                'title' => 'Mentorship'
            ])
            ->hasResources(5)
            ->hasExcos(20)
            ->create();

        Project::factory()
            ->state([
                'type' => ProjectType::schoolAdoption(),
                'title' => 'Adopt a school online'
            ])
            ->hasResources(5)
            ->hasExcos(20)
            ->create();
    }
}
