<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarType;
class CarType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
       $carData = [
        ];
        CarType::create();
    }
}
