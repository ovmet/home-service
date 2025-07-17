<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    public function run()
    {
        Status::create(['name' => 'Recibido']);
        Status::create(['name' => 'En reparación']);
        Status::create(['name' => 'Listo']);
        Status::create(['name' => 'Entregado']);
    }
} 