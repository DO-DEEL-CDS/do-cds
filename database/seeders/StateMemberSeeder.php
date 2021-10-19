<?php

namespace Database\Seeders;

use App\Models\StateMember;
use Illuminate\Database\Seeder;

class StateMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StateMember::factory(100)->create();
    }
}
