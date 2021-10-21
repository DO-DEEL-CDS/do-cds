<?php

namespace Database\Seeders;

use App\Models\Roles\Admin;
use App\Models\Roles\Corper;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::factory(3)
            ->for(Corper::inRandomOrder()->first(), 'user')
            ->for(Admin::first(), 'agent')
            ->create();
    }
}
