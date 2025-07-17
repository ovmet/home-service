<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        Client::create([
            'name' => 'Juan Pérez',
            'phone' => '555-1234',
            'email' => 'juan@example.com',
            'address' => 'Calle Falsa 123',
            'notes' => 'Cliente frecuente',
        ]);
    }
} 