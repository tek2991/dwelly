<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default room array with the room name and if it should be shown in the frontend
        // 'Hall','Dining','Kitchen','Bedroom','Bathroom','Pooja Room','Servant Room','Lobby','Balcony',
        $rooms = [
            ['name' => 'Hall', 'show' => true],
            ['name' => 'Dining', 'show' => true],
            ['name' => 'Kitchen', 'show' => true],
            ['name' => 'Lobby', 'show' => true],
            ['name' => 'Bedroom', 'show' => true],
            ['name' => 'Bathroom', 'show' => true],
            ['name' => 'Pooja Room', 'show' => true],
            ['name' => 'Servant Room', 'show' => true],
            ['name' => 'Balcony', 'show' => true],
        ];

        // Insert the rooms into the database
        foreach ($rooms as $r) {
            \App\Models\Room::create([
                'name' => $r['name'],
                'show' => $r['show'],
            ]);
        }
    }
}
