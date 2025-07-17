<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        Brand::create(['name' => 'Samsung']);
        Brand::create(['name' => 'LG']);
        Brand::create(['name' => 'Whirlpool']);
    }
} 