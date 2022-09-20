<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstablishmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the data to be seeded
        $establishments = [
            'Market',
            'Hospital',
            'School',
            'ATM',
            'Bank',
            'Restaurant',
            'Theatre',
            'Shopping Mall',
            'Airport',
            'Train Station',
            'Bus Stop',
        ];

        // Seed the data
        foreach ($establishments as $establishment) {
            \App\Models\EstablishmentType::create([
                'name' => $establishment,
            ]);
        }
    }
}
