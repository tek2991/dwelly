<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
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
            'Nearby Market',
            'Nearby Hospital',
            'Nearby School',
            'Nearby ATM',
            'Nearby Bank',
            'Nearby Restaurant',
            'Nearby Theatre',
            'Nearby Shopping Mall',
            'Nearby Airport',
            'Nearby Train Station',
            'Nearby Bus Stop',
        ];

        // Seed the data
        foreach ($establishments as $establishment) {
            \App\Models\Establishment::create([
                'name' => $establishment,
            ]);
        }
    }
}
