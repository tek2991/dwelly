<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default localities array
        $localities = [
            ['name' => 'Ambari Fatasil', 'pincode' => '781025', 'city' => 'Guwahati'],
            ['name' => 'Amerigog', 'pincode' => '781023', 'city' => 'Guwahati'],
            ['name' => 'Amingaon', 'pincode' => '781031', 'city' => 'Guwahati'],
            ['name' => 'Amsinggaon', 'pincode' => '781027', 'city' => 'Guwahati'],
            ['name' => 'Assam Sachivalaya', 'pincode' => '781006', 'city' => 'Guwahati'],
            ['name' => 'Azara', 'pincode' => '781017', 'city' => 'Guwahati'],
            ['name' => 'Bamunimaidan', 'pincode' => '781021', 'city' => 'Guwahati'],
            ['name' => 'Basistha', 'pincode' => '781029', 'city' => 'Guwahati'],
            ['name' => 'Beltola', 'pincode' => '781028', 'city' => 'Guwahati'],
            ['name' => 'Bharalumukh', 'pincode' => '781009', 'city' => 'Guwahati'],
            ['name' => 'Bhetapara', 'pincode' => '781017', 'city' => 'Guwahati'],
            ['name' => 'Bonda', 'pincode' => '781026', 'city' => 'Guwahati'],
            ['name' => 'Chandmari', 'pincode' => '781003', 'city' => 'Guwahati'],
            ['name' => 'Christian Basti', 'pincode' => '781005', 'city' => 'Guwahati'],
            ['name' => 'Commerce Colony', 'pincode' => '781003', 'city' => 'Guwahati'],
            ['name' => 'Dharapur', 'pincode' => '781017', 'city' => 'Guwahati'],
            ['name' => 'Dhirenpara', 'pincode' => '781025', 'city' => 'Guwahati'],
            ['name' => 'Dispur', 'pincode' => '781005', 'city' => 'Guwahati'],
            ['name' => 'Dwarka Nagar', 'pincode' => '781036', 'city' => 'Guwahati'],
            ['name' => 'Ganeshguri', 'pincode' => '781005', 'city' => 'Guwahati'],
            ['name' => 'Garchuk', 'pincode' => '781035', 'city' => 'Guwahati'],
            ['name' => 'Gotanagar', 'pincode' => '781011', 'city' => 'Guwahati'],
            ['name' => 'Guwahati Airport', 'pincode' => '781015', 'city' => 'Guwahati'],
            ['name' => 'Guwahati University', 'pincode' => '781014', 'city' => 'Guwahati'],
            ['name' => 'Hatigaon', 'pincode' => '781038', 'city' => 'Guwahati'],
            ['name' => 'Hatigaon Chariali', 'pincode' => '781038', 'city' => 'Guwahati'],
            ['name' => 'Hengrabari', 'pincode' => '781036', 'city' => 'Guwahati'],
            ['name' => 'I I T', 'pincode' => '781039', 'city' => 'Guwahati'],
            ['name' => 'Jalukbari', 'pincode' => '781013', 'city' => 'Guwahati'],
            ['name' => 'Japorigog', 'pincode' => '781005', 'city' => 'Guwahati'],
            ['name' => 'Jayanagar', 'pincode' => '781022', 'city' => 'Guwahati'],
            ['name' => 'Kahilipara', 'pincode' => '781019', 'city' => 'Guwahati'],
            ['name' => 'Kalapahar', 'pincode' => '781018', 'city' => 'Guwahati'],
            ['name' => 'Kamakhya', 'pincode' => '781010', 'city' => 'Guwahati'],
            ['name' => 'Khanapara', 'pincode' => '781022', 'city' => 'Guwahati'],
            ['name' => 'Kharguli', 'pincode' => '781004', 'city' => 'Guwahati'],
            ['name' => 'Lachit Nagar', 'pincode' => '781005', 'city' => 'Guwahati'],
            ['name' => 'Lalmati', 'pincode' => '781029', 'city' => 'Guwahati'],
            ['name' => 'Lokhra', 'pincode' => '781035', 'city' => 'Guwahati'],
            ['name' => 'Maligaon', 'pincode' => '781011', 'city' => 'Guwahati'],
            ['name' => 'Mathura Nagar', 'pincode' => '781036', 'city' => 'Guwahati'],
            ['name' => 'Narengi', 'pincode' => '781026', 'city' => 'Guwahati'],
            ['name' => 'Noonmati', 'pincode' => '781020', 'city' => 'Guwahati'],
            ['name' => 'North Guwahati', 'pincode' => '781030', 'city' => 'Guwahati'],
            ['name' => 'Odalbakra', 'pincode' => '781034', 'city' => 'Guwahati'],
            ['name' => 'Pan Bazar', 'pincode' => '781001', 'city' => 'Guwahati'],
            ['name' => 'Pandu', 'pincode' => '781012', 'city' => 'Guwahati'],
            ['name' => 'Panikhaiti', 'pincode' => '781026', 'city' => 'Guwahati'],
            ['name' => 'Panjabari', 'pincode' => '781037', 'city' => 'Guwahati'],
            ['name' => 'Pillangkata', 'pincode' => '781029', 'city' => 'Guwahati'],
            ['name' => 'Rajghar', 'pincode' => '781003', 'city' => 'Guwahati'],
            ['name' => 'Rehabari', 'pincode' => '781008', 'city' => 'Guwahati'],
            ['name' => 'Rongmahal', 'pincode' => '781030', 'city' => 'Guwahati'],
            ['name' => 'Rukminigaon', 'pincode' => '781022', 'city' => 'Guwahati'],
            ['name' => 'Sadilapur', 'pincode' => '781012', 'city' => 'Guwahati'],
            ['name' => 'Satgaon', 'pincode' => '781027', 'city' => 'Guwahati'],
            ['name' => 'Sawkuchi', 'pincode' => '781040', 'city' => 'Guwahati'],
            ['name' => 'Shreenagar', 'pincode' => '781006', 'city' => 'Guwahati'],
            ['name' => 'Silpukhuri', 'pincode' => '781003', 'city' => 'Guwahati'],
            ['name' => 'Six Mile', 'pincode' => '781022', 'city' => 'Guwahati'],
            ['name' => 'Survey', 'pincode' => '781028', 'city' => 'Guwahati'],
            ['name' => 'Ulubari', 'pincode' => '781007', 'city' => 'Guwahati'],
            ['name' => 'VIP Road', 'pincode' => '781022', 'city' => 'Guwahati'],
            ['name' => 'Wireless', 'pincode' => '781028', 'city' => 'Guwahati'],
            ['name' => 'Zoo Road', 'pincode' => '781024', 'city' => 'Guwahati']
        ];
        
        // Loop through the locatities array and a new locality for each
        foreach ($localities as $locality) {
            \App\Models\Locality::create($locality);
        }
    }
}
