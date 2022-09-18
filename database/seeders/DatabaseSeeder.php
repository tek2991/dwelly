<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'tek2991@gmail.com',
        ]);

        $this->call([
            AmenitiesSeeder::class,
            FlooringSeeder::class,
            FurnishingSeeder::class,
            FurnitureSeeder::class,
            LocalitySeeder::class,
            PropertyTypeSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
