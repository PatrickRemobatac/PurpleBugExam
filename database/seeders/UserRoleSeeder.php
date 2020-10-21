<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin Admin',
            'email' => 'admin@gmail.com',
            'role_id' => '1',
            'email_verified_at' => now(),
            'password' => Hash::make('adminadmin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'User User',
            'email' => 'user@gmail.com',
            'role_id' => '2',
            'email_verified_at' => now(),
            'password' => Hash::make('useruser'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'id' => 1,
            'role_name' => 'Administrator',
            'description' => 'For Admin User',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'role_name' => 'User',
            'description' => 'For User Only',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
