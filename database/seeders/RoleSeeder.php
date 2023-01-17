<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => "super_admin",
            'guard_name' => "api",
            "created_at" => Carbon::now()
        ];
        $role = Role::create($data);
        $permissions = Permission::get();
        $role->syncPermissions($permissions);
    }
}