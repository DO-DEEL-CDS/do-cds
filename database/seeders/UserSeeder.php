<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)
            ->hasProfile()
            ->create();

        User::factory(1)
            ->state([
                'email' => 'admin@example.com',
                'password' => Hash::make('password123')
            ])
            ->hasProfile()
            ->create();
    }
}
