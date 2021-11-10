<?php

namespace Database\Seeders;

use App\Models\TrainingAttendance;
use Illuminate\Database\Seeder;

class TrainingAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrainingAttendance::factory(15)->create();
    }
}
