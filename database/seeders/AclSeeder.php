<?php

namespace Database\Seeders;

use App\Models\Permission;
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
        $admin->syncPermissions($this->permissions());

        $corper = Role::create([
                'name' => 'corper'
        ]);
        $corper->syncPermissions($this->corperPermissions());
    }

    public function permissions(): array
    {
        $permissions[] = Permission::create(['name' => 'manage-prospects']);
        $permissions[] = Permission::create(['name' => 'manage-users']);
        $permissions[] = Permission::create(['name' => 'manage-training']);
        $permissions[] = Permission::create(['name' => 'manage-attendance']);
        $permissions[] = Permission::create(['name' => 'manage-project']);
        $permissions[] = Permission::create(['name' => 'manage-article']);
        $permissions[] = Permission::create(['name' => 'manage-job']);
        $permissions[] = Permission::create(['name' => 'manage-state']);
        return $permissions;
    }

    public function corperPermissions(): array
    {
        $permissions[] = Permission::create(['name' => 'access-projects']);
        $permissions[] = Permission::create(['name' => 'access-jobs']);
        return $permissions;
    }
}
