<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultPriorities = (new \App\Models\Priority())->defaultPriorities();

        foreach ($defaultPriorities as $priority) {
            \App\Models\Priority::updateOrCreate(['name' => $priority]);
        }
    }
}
