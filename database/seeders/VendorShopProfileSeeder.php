<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::whereEmail('vendor@gmail.com')->first();

        Vendor::create([
            'banner' => '123.jpg',
            'shop_name' => 'Vendor Shop',
            'phone' => '123123123',
            'email' => 'vendor@gmail.com',
            'address' => 'USA',
            'description' => 'shop description',
            'user_id' => $user->id,
        ]);
    }
}
