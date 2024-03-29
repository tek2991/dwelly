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
            'name' => 'Admin',
            'email' => 'tek2991@gmail.com',
        ]);

        $this->call([
            AmenitySeeder::class,
            FlooringSeeder::class,
            FurnishingSeeder::class,
            FurnitureSeeder::class,
            LocalitySeeder::class,
            PropertyTypeSeeder::class,
            RoomSeeder::class,
            EstablishmentTypeSeeder::class,
            BhkSeeder::class,
            RoleSeeder::class,
            DocumentTypeSeeder::class,
            AuditTypeSeeder::class,
            TaskStateSeeder::class,
            PrioritySeeder::class,
        ]);
    }
}
