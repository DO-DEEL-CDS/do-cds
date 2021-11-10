<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $corperRole = Role::findByName('corper');
        User::factory(1)
            ->state([
                'email' => 'corpmember@example.com',
                'password' => Hash::make('password123')
            ])
            ->hasAttached($corperRole)
            ->hasProfile()
            ->create();

        if (!app()->environment('production')) {
            User::factory(5)
                ->hasAttached($corperRole)
                ->hasProfile()
                ->create();
        }

        $admin = Role::findByName('admin');
        User::factory(1)
            ->state([
                'email' => 'admin@example.com',
                'password' => Hash::make('password123')
            ])
            ->hasAttached($admin)
            ->hasProfile()
            ->create();
    }
}
