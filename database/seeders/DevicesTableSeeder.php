<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DevicesTableSeeder extends Seeder
{
    public function run()
    {
        Device::create([
            'client_id' => 1,
            'brand_id' => 1,
            'device_type_id' => 1,
            'model' => 'RF23J9011SR',
            'serial_number' => 'SN123456',
        ]);
    }
} 