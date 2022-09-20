<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default amenities array with the amenities name and the icon name in the storage/app/uploads/icons folder and if it should be shown in the frontend
        $amenities = [
            ['name' => 'Pets Friendly', 'icon_path' => 'uploads/icons/pet.svg', 'show' => true],
            ['name' => 'Bachelor Friendly', 'icon_path' => 'uploads/icons/bachelor.svg', 'show' => true],
            ['name' => 'Student Friendly', 'icon_path' => 'uploads/icons/student.svg', 'show' => true],
            ['name' => 'Couples Friendly', 'icon_path' => 'uploads/icons/couple.svg', 'show' => true],
            ['name' => 'Family Friendly', 'icon_path' => 'uploads/icons/family.svg', 'show' => true],
            ['name' => 'Parking', 'icon_path' => 'uploads/icons/parking.svg', 'show' => true],
            ['name' => 'Lift', 'icon_path' => 'uploads/icons/lift.svg', 'show' => true],
            ['name' => 'Power Backup', 'icon_path' => 'uploads/icons/power-backup.svg', 'show' => true],
            ['name' => 'Security', 'icon_path' => 'uploads/icons/security.svg', 'show' => true],
            ['name' => 'Swimming Pool', 'icon_path' => 'uploads/icons/swimming-pool.svg', 'show' => false],
            ['name' => 'Gym', 'icon_path' => 'uploads/icons/gym.svg', 'show' => true],
            ['name' => 'Recreation', 'icon_path' => null, 'show' => true],
            ['name' => 'Community', 'icon_path' => 'uploads/icons/community.svg', 'show' => true],
        ];

        // Insert the amenities into the database
        foreach ($amenities as $a) {
            \App\Models\Amenity::create([
                'name' => $a['name'],
                'icon_path' => $a['icon_path'],
                'show' => $a['show'],
            ]);
        }
    }
}
