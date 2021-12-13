<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Category::factory(10)->create();
        Category::factory(1)
                ->state([
                        'title' => 'general',
                        'slug' => 'general'
                ])
                ->create();
    }
}
