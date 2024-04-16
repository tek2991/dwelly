<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default property types array with name and description
        $propertyTypes = [
            [
                'name' => 'Apartment',
                'description' => 'A flat or apartment is a self-contained housing unit (a type of residential real estate) that occupies only part of a building, generally on a single floor. There are many types of apartments, including duplexes, condominiums and apartments with several bedrooms.',
            ],
            [
                'name' => 'House',
                'description' => 'A house is a building that functions as a home. They can range from simple dwellings such as rudimentary huts of nomadic tribes and the improvised shacks in shantytowns to complex, fixed structures of wood, brick, concrete or other materials containing plumbing, ventilation and electrical systems.',
            ],
            [
                'name' => 'Villa',
                'description' => 'A villa is a large, detached house, usually located in the suburbs or semi-rural areas. A villa may be a separate house, or connected to one or more adjacent dwellings, with a dividing fence or hedge in between. It may also be part of an apartment block or a terraced house.',
            ],
            [
                'name' => 'Studio',
                'description' => 'A studio apartment is a small apartment which combines living, sleeping, and cooking areas into one room. Studio apartments are sometimes called efficiency apartments. They are usually smaller than one-bedroom apartments, with a total area of 300 to 500 square feet (28 to 46 m2).',
            ],
            [
                'name' => 'Penthouse',
                'description' => 'A penthouse is a luxury apartment or unit on the top floor of a building. It may also be a separate building altogether. The word penthouse is a neologism, coined in the 1920s, from penthouse (from Latin pons, "bridge"), referring to the top floor of a building.',
            ],
            [
                'name' => 'Townhouse',
                'description' => 'A townhouse, or town house, is a type of terraced housing. It is a single-family home, usually smaller than a detached house, that may be part of a group of similar structures, containing from three to six or more units in multiple buildings.',
            ],
            [
                'name' => 'Bungalow',
                'description' => 'A bungalow is a type of building, originally developed in the Bengal region of the Indian subcontinent. The word bungalow originally referred to a style of architecture, and was used to describe any one of a number of types of building.',
            ],
            [
                'name' => 'Farmhouse',
                'description' => 'A farmhouse is a building that serves as the primary residence for a farmer and his or her family. The farmhouse is often extended to include outbuildings such as barns, stables, and silos. The farmhouse is typically a large dwelling, often two stories or higher.',
            ],
            [
                'name' => 'Cottage',
                'description' => 'A cottage is a small house, typically in a rural or semi-rural location. The word "cottage" has its origins in the Latin cottus, meaning "a small house". The term "cottage" has been used to describe a range of small houses, from the medieval period to the present day.',
            ],
            [
                'name' => 'Duplex',
                'description' => 'A duplex is a type of multi-family housing in which one building contains two separate residences, with separate entrances for each. Duplexes are a type of multiple dwelling, a residential building containing more than one dwelling unit.',
            ],
        ];

        // Loop through the array and create a new property type for each
        foreach ($propertyTypes as $propertyType) {
            \App\Models\PropertyType::create([
                'name' => $propertyType['name'],
                'description' => $propertyType['description'],
            ]);
        }
    }
}
