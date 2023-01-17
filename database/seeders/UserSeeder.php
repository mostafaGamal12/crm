<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
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
        $data = [
            'first_name' => "Mostafa",
            'last_name' => "Gamal",
            'job_title' => "Gm",
            'email' => "mostafa@gmail.com",
            "active" => 1,
            "first_login" => 1,
            "password" => Hash::make("123123"),
            "created_at" => Carbon::now()
        ];
        $role = Role::find(1);
        $user = User::create($data);
        $user->syncRoles($role);
        $user->companies()->attach([1,2]);
        $user->syncPermissions($role->permissions);
    }
}