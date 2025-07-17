<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeviceType;

class DeviceTypesTableSeeder extends Seeder
{
    public function run()
    {
        DeviceType::create(['name' => 'Refrigerador']);
        DeviceType::create(['name' => 'Lavadora']);
        DeviceType::create(['name' => 'Televisor']);
    }
} 