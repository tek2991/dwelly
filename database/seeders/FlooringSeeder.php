<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlooringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default floorings array
        $floorings = [
            'Vitrified',
            'Marbled',
            'Cemented',
            'Carpeted',
            'Wooden',
            'Stone',
            'Brick',
            'Mosaic',
        ];

        // Loop through the array and create a new flooring for each
        foreach ($floorings as $flooring) {
            \App\Models\Flooring::create([
                'name' => $flooring,
            ]);
        }
    }
}
