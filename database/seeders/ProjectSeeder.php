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
                'title' => 'Google My Business',
                'overview' => "What is Google My Business and how does it work? \r\n A Google My Business account ensures that when someone looks your company up on Google Search and Google Maps, they find it. Once they do, your listing shows searches where and how to visit your shop, whether you have a web or physical address. Google My Business accounts also improve your local SEO.",
                'guide' => "DODEEL corp members are to help at least 10 businesses in their local community get onboarded on GMB. This includes registering them on GMB and filling the link provided to ensure the businesses are verified.",
            ])
//            ->hasResources(2)
//            ->hasBusinesses(10)
//            ->hasExcos(5)
            ->create();

        Project::factory()
            ->state([
                'type' => ProjectType::hackathon(),
                'title' => 'Hackathon',
                'overview' => "What is Google My Business and how does it work? \n\r A Google My Business account ensures that when someone looks your company up on Google Search and Google Maps, they find it. Once they do, your listing shows searches where and how to visit your shop, whether you have a web or physical address. Google My Business accounts also improve your local SEO.",
                'guide' => "DO DEEl CDS members in each state with skills like programming, project development, and product designing are to come together ideate and build possible solutions.",
            ])
//            ->hasResources(5)
//            ->hasExcos(20)
            ->create();

        Project::factory()
            ->state([
                'type' => ProjectType::mentorship(),
                'title' => 'Mentorship',
                'overview' => "Do Deel corp members in each state are expected to adopt secondary schools and mentor students on internet safety, the importance of being a digital citizen and how to harness digital resources positively.",
                'guide' => "CDS members are to prepare materials and a curriculum for the school mentorship. \n\n Each batch will take out some of their CDS days to go to schools and speak to different classes using as many aids as possible to communicate."
            ])
//            ->hasResources(5)
//            ->hasExcos(20)
            ->create();

        Project::factory()
            ->state([
                'type' => ProjectType::schoolAdoption(),
                'title' => 'Adopt a school online',
                'overview' => "CDS members are to prepare materials and a curriculum for the school mentorship. \n\r Each batch will take out some of their CDS days to go to schools and speak to different classes using as many aids as possible to communicate.",
                'guide' => "CDS members are to prepare materials and a curriculum for the school mentorship. \n\n Each batch will take out some of their CDS days to go to schools and speak to different classes using as many aids as possible to communicate.",
            ])
//            ->hasResources(5)
//            ->hasExcos(20)
            ->create();
    }
}
