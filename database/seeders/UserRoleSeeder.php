<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\Role();
        $admin->name = 'Admin';
        $admin->save();

        $admin = new \App\Models\Role();
        $admin->name = 'Author';
        $admin->save();

        $users = User::all();

        $adminRole = \App\Models\Role::where('name', 'Admin')->get();
        foreach ($users as $user) {
            $user->roles()->attach($adminRole);
            $user->save();
        }
    }
}
