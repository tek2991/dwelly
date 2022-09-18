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
            ['name' => 'Pets Friendly', 'icon_path' => 'uploads/icons/pets_friendly.png', 'show' => true],
            ['name' => 'Bachlor Friendly', 'icon_path' => 'uploads/icons/bachlor_friendly.png', 'show' => true],
            ['name' => 'Student Friendly', 'icon_path' => 'uploads/icons/student_friendly.png', 'show' => true],
            ['name' => 'Couples Friendly', 'icon_path' => 'uploads/icons/couples_friendly.png', 'show' => true],
            ['name' => 'Family Friendly', 'icon_path' => 'uploads/icons/family_friendly.png', 'show' => true],
            ['name' => 'Parking', 'icon_path' => 'uploads/icons/parking.png', 'show' => true],
            ['name' => 'Lift', 'icon_path' => 'uploads/icons/lift.png', 'show' => true],
            ['name' => 'Power Backup', 'icon_path' => 'uploads/icons/power_backup.png', 'show' => true],
            ['name' => 'Security', 'icon_path' => 'uploads/icons/security.png', 'show' => true],
            ['name' => 'Swimming Pool', 'icon_path' => 'uploads/icons/swimming_pool.png', 'show' => true],
            ['name' => 'Gym', 'icon_path' => 'uploads/icons/gym.png', 'show' => true],
            ['name' => 'Recreation', 'icon_path' => 'uploads/icons/recreation.png', 'show' => true],
            ['name' => 'Community', 'icon_path' => 'uploads/icons/community.png', 'show' => true],
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
