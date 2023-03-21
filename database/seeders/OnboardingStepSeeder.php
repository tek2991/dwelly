<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OnboardingStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $steps = [
            'Add Property details',
            'Add Owner details',
            'Add Rooms',
            'Add Furnitures',
            'Perform Onboarding Audit',
            'Onboarding Completed'
        ];

        foreach ($steps as $step) {
            \App\Models\OnboardingStep::create([
                'name' => $step
            ]);
        }
    }
}
