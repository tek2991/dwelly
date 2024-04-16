<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FurnishingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default furnishing array
        $furnishings = [
            'Semi-Furnished',
            'Unfurnished',
            'Fully-Furnished',
        ];

        // Loop through the array and create a new furnishing for each
        foreach ($furnishings as $furnishing) {
            \App\Models\Furnishing::create([
                'name' => $furnishing,
            ]);
        }
    }
}
