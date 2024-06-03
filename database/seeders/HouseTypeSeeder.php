<?php

namespace Database\Seeders;

use App\Models\HouseType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HouseType::factory(5)->create();
    }
}
