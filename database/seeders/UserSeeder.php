<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'username'=> 'admin',
            'phone'=> '996557992000',
            'role'=> 'admin',
            'status'=> 'active',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
        ]);

        User::factory()->create([
            'name' => 'Vendor',
            'username'=> 'vendor',
            'phone'=> '996557992001',
            'role'=> 'vendor',
            'status'=> 'active',
            'email' => 'vendor@gmail.com',
            'password' => bcrypt('123123123'),
        ]);

        User::factory()->create([
            'name' => 'User',
            'username'=> 'user',
            'phone'=> '996557992002',
            'role'=> 'user',
            'status'=> 'active',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123123123'),
        ]);
    }
}
