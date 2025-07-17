<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClientsTableSeeder::class,
            TechniciansTableSeeder::class,
            BrandsTableSeeder::class,
            DeviceTypesTableSeeder::class,
            DevicesTableSeeder::class,
            StatusesTableSeeder::class,
            RepairOrdersTableSeeder::class,
        ]);
    }
}
