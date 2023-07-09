<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::whereEmail('admin@gmail.com')->first();

        Vendor::create([
            'banner' => '123.jpg',
            'shop_name' => 'Admin Shop',
            'phone' => '123123123',
            'email' => 'admin@gmail.com',
            'address' => 'USA',
            'description' => 'shop description',
            'user_id' => $user->id,
        ]);
    }
}
