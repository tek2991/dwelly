<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultTypes = \App\Models\AuditType::defaultTypes();

        foreach ($defaultTypes as $type) {
            \App\Models\AuditType::firstOrCreate(['name' => $type]);
        }
    }
}
