<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BhkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default bhks
        $bhks = [
            '1 BHK',
            '2 BHK',
            '3 BHK',
            '4 BHK',
        ];

        foreach ($bhks as $bhk) {
            \App\Models\Bhk::create([
                'name' => $bhk,
            ]);
        }
    }
}
