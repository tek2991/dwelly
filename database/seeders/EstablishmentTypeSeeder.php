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
        // $establishments = [
        //     'Market',
        //     'Hospital',
        //     'School',
        //     'ATM',
        //     'Bank',
        //     'Restaurant',
        //     'Theatre',
        //     'Shopping Mall',
        //     'Airport',
        //     'Train Station',
        //     'Bus Stop',
        // ];

        $establishments = [
            [
                'name' => 'Market',
                'icon_path' => 'uploads/icons/market.svg',
            ],
            [
                'name' => 'Hospital',
                'icon_path' => 'uploads/icons/hospital.svg',
            ],
            [
                'name' => 'School',
                'icon_path' => 'uploads/icons/school.svg',
            ],
            [
                'name' => 'ATM',
                'icon_path' => 'uploads/icons/atm.svg',
            ],
            [
                'name' => 'Bank',
                'icon_path' => 'uploads/icons/bank.svg',
            ],
            [
                'name' => 'Restaurant',
                'icon_path' => 'uploads/icons/restaurant.svg',
            ],
            [
                'name' => 'Theatre',
                'icon_path' => 'uploads/icons/theatre.svg',
            ],
            [
                'name' => 'Shopping Mall',
                'icon_path' => 'uploads/icons/shopping-mall.svg',
            ],
            [
                'name' => 'Airport',
                'icon_path' => 'uploads/icons/airport.svg',
            ],
            [
                'name' => 'Train Station',
                'icon_path' => 'uploads/icons/train-station.svg',
            ],
            [
                'name' => 'Bus Stop',
                'icon_path' => 'uploads/icons/bus-stop.svg',
            ],
        ];

        // Seed the data
        foreach ($establishments as $establishment) {
            \App\Models\EstablishmentType::create([
                'name' => $establishment['name'],
                'icon_path' => $establishment['icon_path'],
            ]);
        }
    }
}
