<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultStates = (new \App\Models\TaskState())->defaultStates();

        foreach ($defaultStates as $state) {
            \App\Models\TaskState::updateOrCreate(['name' => $state]);
        }
    }
}
