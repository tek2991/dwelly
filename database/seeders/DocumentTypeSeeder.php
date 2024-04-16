<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the document types
        $types = [
            'Aadhar Card',
            'PAN Card',
            'Driving License',
            'Passport',
            'Voter ID',
            'Ration Card',
            'Bank Statement',
            'Salary Slip',
            'Form 16',
            'ITR',
            'Rent Agreement',
            'Electricity Bill',
            'Water Bill',
            'Gas Bill',
            'Telephone Bill',
            'Other',
        ];

        // Create the document types
        foreach ($types as $type) {
            \App\Models\DocumentType::create([
                'name' => $type,
                'description' => 'Document type for ' . $type,
            ]);
        }
    }
}
