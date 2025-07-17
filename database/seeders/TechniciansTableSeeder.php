<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technician;

class TechniciansTableSeeder extends Seeder
{
    public function run()
    {
        Technician::create([
            'name' => 'Pedro Técnico',
            'phone' => '555-5678',
            'email' => 'pedro@tecnicos.com',
            'address' => 'Av. Técnica 456',
            'notes' => 'Especialista en línea blanca',
        ]);
    }
} 