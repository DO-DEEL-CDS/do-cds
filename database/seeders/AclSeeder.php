<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Super Admin'
        ]);

        $admin = Role::create([
            'name' => 'admin'
        ]);
        $admin->syncPermissions()->syncPermissions();

        $corper = Role::create([
            'name' => 'corper'
        ]);
        $corper->syncPermissions($this->corperPermissions());
    }

    public function corperPermissions()
    {
    }

    public function adminPermissions()
    {
    }

    public function permissions()
    {
    }
}
