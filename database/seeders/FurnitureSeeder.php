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
        $furnitures = [
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

        $secondary_furnitures = [
            [
                'primary' => 'Sofa',
                'secondary' => [
                    'Single Seater Sofa', 'Two Seater Sofa', 'Three Seater Sofa', 'Four Seater Sofa', 'Five Seater Sofa', 'Coffee Table'
                ]
            ],
            [
                'primary' => 'Bed',
                'secondary' => [
                    'Mattress', 'Bed Sheet', 'Pillow', 'Blanket', 'Quilt', 'Bedside Table'
                ]
            ],
            [
                'primary' => 'Dining Set',
                'secondary' => [
                    'Dining Table', 'Dining Chair', 'Dining Stool'
                ]
            ],
        ];


        foreach ($furnitures as $furniture) {
            \App\Models\Furniture::updateOrCreate(
                ['name' => $furniture['name']],
                $furniture
            );
        }

        foreach ($secondary_furnitures as $secondary_furniture) {
            $primary_furniture = \App\Models\Furniture::where('name', $secondary_furniture['primary'])->first();
            foreach ($secondary_furniture['secondary'] as $secondary) {
                \App\Models\Furniture::updateOrCreate(
                    ['name' => $secondary],
                    [
                        'name' => $secondary,
                        'icon_path' => null,
                        'show' => false,
                        'is_primary' => false,
                        'primary_furniture_id' => $primary_furniture->id,
                    ]
                );
            }
        }
    }
}
