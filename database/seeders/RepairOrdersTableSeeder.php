<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RepairOrder;

class RepairOrdersTableSeeder extends Seeder
{
    public function run()
    {
        RepairOrder::create([
            'device_id' => 1,
            'technician_id' => 1,
            'status_id' => 1,
            'description' => 'No enfría correctamente',
            'cost' => 1200.00,
            'entry_date' => now(),
            'exit_date' => null,
            'notes' => 'Requiere revisión de compresor',
        ]);
    }
} 