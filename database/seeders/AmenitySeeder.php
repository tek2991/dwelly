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
            ['name' => 'Pets Friendly', 'icon' => 'uploads/icons/pets_friendly.png', 'show' => true],
            ['name' => 'Bachlor Friendly', 'icon' => 'uploads/icons/bachlor_friendly.png', 'show' => true],
            ['name' => 'Student Friendly', 'icon' => 'uploads/icons/student_friendly.png', 'show' => true],
            ['name' => 'Couples Friendly', 'icon' => 'uploads/icons/couples_friendly.png', 'show' => true],
            ['name' => 'Family Friendly', 'icon' => 'uploads/icons/family_friendly.png', 'show' => true],
            ['name' => 'Parking', 'icon' => 'uploads/icons/parking.png', 'show' => true],
            ['name' => 'Lift', 'icon' => 'uploads/icons/lift.png', 'show' => true],
            ['name' => 'Power Backup', 'icon' => 'uploads/icons/power_backup.png', 'show' => true],
            ['name' => 'Security', 'icon' => 'uploads/icons/security.png', 'show' => true],
            ['name' => 'Swimming Pool', 'icon' => 'uploads/icons/swimming_pool.png', 'show' => true],
            ['name' => 'Gym', 'icon' => 'uploads/icons/gym.png', 'show' => true],
            ['name' => 'Recreation', 'icon' => 'uploads/icons/recreation.png', 'show' => true],
            ['name' => 'Community', 'icon' => 'uploads/icons/community.png', 'show' => true],
        ];

        // Insert the amenities into the database
        foreach ($amenities as $a) {
            \App\Models\Amenity::create([
                'name' => $a['name'],
                'icon' => $a['icon'],
                'show' => $a['show'],
            ]);
        }
    }
}
