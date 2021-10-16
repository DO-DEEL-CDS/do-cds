<?php

namespace Database\Seeders;

use App\Models\Prospect;
use Illuminate\Database\Seeder;

class ProspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Prospect::create([
            'name' => 'Doug',
            'email' => 'corper@example.com',
            'nysc_state_code' => 'FC/21A/0000',
        ]);
        Prospect::factory(5)->create();
    }
}
