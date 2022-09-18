<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default furniture array with the furniture name and the icon name in the storage/app/uploads/icons folder and if it should be shown in the frontend
        $furniture = [
            ['name' => 'Fan', 'icon_path' => 'uploads/icons/fan.svg', 'show' => true],
            ['name' => 'Light', 'icon_path' => 'uploads/icons/light.svg', 'show' => true],
            ['name' => 'Kitchen Cabinet', 'icon_path' => null, 'show' => false],
            ['name' => 'Wardrobe', 'icon_path' => null, 'show' => false],
            ['name' => 'Sofa', 'icon_path' => 'uploads/icons/sofa.svg', 'show' => true],
            ['name' => 'Dining Set', 'icon_path' => null, 'show' => false],
            ['name' => 'Bed', 'icon_path' => 'uploads/icons/bed.svg', 'show' => true],
            ['name' => 'Mattress', 'icon_path' => null, 'show' => false],
            ['name' => 'Gas Stove', 'icon_path' => null, 'show' => false],
            ['name' => 'Induction Stove', 'icon_path' => null, 'show' => false],
            ['name' => 'Microwave', 'icon_path' => null, 'show' => false],
            ['name' => 'Gas Cylinder', 'icon_path' => null, 'show' => false],
            ['name' => 'Exhaust Fan', 'icon_path' => null, 'show' => false],
            ['name' => 'Kitchen Chimney', 'icon_path' => null, 'show' => false],
            ['name' => 'Water Purifier', 'icon_path' => null, 'show' => false],
            ['name' => 'Geyser', 'icon_path' => 'uploads/icons/geyser.svg', 'show' => true],
            ['name' => 'Air Conditioner', 'icon_path' => 'uploads/icons/air-conditioner.svg', 'show' => true],
            ['name' => 'Television', 'icon_path' => 'uploads/icons/television.svg', 'show' => true],
            ['name' => 'Fridge', 'icon_path' => 'uploads/icons/fridge.svg', 'show' => true],
            ['name' => 'Washing Machine', 'icon_path' => 'uploads/icons/washing-machine.svg', 'show' => true],
            ['name' => 'Inverter', 'icon_path' => null, 'show' => false],
            ['name' => 'Study Table', 'icon_path' => null, 'show' => false],
            ['name' => 'Chair', 'icon_path' => null, 'show' => false],
        ];

        // Insert the furniture into the database
        foreach ($furniture as $f) {
            \App\Models\Furniture::create([
                'name' => $f['name'],
                'icon_path' => $f['icon_path'],
                'show' => $f['show'],
            ]);
        }
    }
}
