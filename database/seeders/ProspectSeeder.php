<?php

namespace Database\Seeders;

use App\Enums\ProspectStatus;
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
                'status' => ProspectStatus::Approved(),
        ]);

        if (!app()->environment('production')) {
            Prospect::factory(2)->create();
        }
    }
}
