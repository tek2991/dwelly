<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PublicPageController extends Controller
{
    public function index()
    {
        return view('public.index');
    }

    public function allProperties()
    {
        return view('public.allProperties');
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function owners()
    {
        return view('public.owners');
    }

    public function update()
    {
        return ('No updates');
        // increase time limit of function to 10 mins
        set_time_limit(600);

        // increase memory limit of function to 2 GB
        ini_set('memory_limit', '2048M');

        // increase max execution time of function to 10 mins
        ini_set('max_execution_time', 600);
        

        function csvToArray($filename = '', $delimiter = ',')
        {
            if (!file_exists($filename) || !is_readable($filename))
                return false;

            $header = null;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== false) {
                while (($row = fgetcsv($handle, 100000, $delimiter)) !== false) {
                    if (!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }

            return $data;
        }

        // $properties = csvToArray('database/old_data/properties.csv');
        $properties = csvToArray(base_path('database/old_data/properties.csv'));


        // Sample property item in the array
        /**
         * array:24 [
         * "property_id" => "60"
         * "property_code" => "GAU039"
         * "locality" => "64"
         * "available" => "1"
         * "type" => "1"
         * "bhk" => "2"
         * "bath" => "2"
         * "flooring" => "1"
         * "building" => "Sanaka Residency"
         * "landmark" => "Near Downtown Hospital"
         * "address" => "Shakuntala Path"
         * "keyword" => "rent, 2BHK, Downtown, Mathura Nagar"
         * "floor_space" => "950"
         * "latitude" => "26.139222"
         * "longitude" => "91.802361"
         * "rent" => "16000"
         * "society_fee" => "1500"
         * "available_from" => "2021-10-30"
         * "security_deposit" => "32000"
         * "booking_amt" => "8000"
         * "vip" => "1"
         * "creator" => "admin"
         * "created_at" => "2020-12-31 13:13:32"
         * "token_creation" => "779714"
         *] 
         */
        // $property_rooms = csvToArray('database/old_data/properties_rooms.csv');
        $property_rooms = csvToArray(base_path('database/old_data/properties_rooms.csv'));

        // Sample property room item in the array
        /**
         * array:13 [
         *  "property_id" => "18"
         *  "hall" => "1"
         *  "dining" => "1"
         *  "kitchen" => "1"
         *  "bedroom" => "1"
         *  "washroom" => "2"
         *  "pooja" => "0"
         *  "servant" => "0"
         *  "lobby" => "0"
         *  "balcony" => "2"
         *  "floor" => "10"
         *  "floor_max" => "10"
         *  "furnish" => "2"
         *]
         */

        // $property_furnitures = csvToArray('database/old_data/properties_furnishing.csv');
        $property_furnitures = csvToArray(base_path('database/old_data/properties_furnishing.csv'));

        // Sample property furnitures item in the array
        /**
         * array:25 [
         *  "property_id" => "18"
         *  "fan" => "4"
         *  "light" => "7"
         *  "k_cabinet" => "0"
         *  "wardrobe" => "1"
         *  "sofa" => "1"
         *  "dining_set" => "1"
         *  "bed" => "2"
         *  "mattress" => "2"
         *  "g_stove" => "1"
         *  "i_stove" => "0"
         *  "Microwave" => "0"
         *  "g_cylinder" => "0"
         *  "e_fan" => "0"
         *  "k_chimney" => "0"
         *  "w_purifier" => "0"
         *  "geyser" => "0"
         *  "AC" => "2"
         *  "TV" => "1"
         *  "fridge" => "1"
         *  "wc" => "0"
         *  "inverter" => "0"
         *  "s_table" => "0"
         *  "sd_table" => "0"
         *  "chair" => "0"
         *]
         */


        // $property_furniture_descriptions = csvToArray('database/old_data/properties_furnishing_rk.csv');
        $property_furniture_descriptions = csvToArray(base_path('database/old_data/properties_furnishing_rk.csv'));
        // Sample property furnitures description item in the array
        /**
         * array:25 [
         *"property_id" => "18"
         *"fan_rk" => ""
         *"light_rk" => ""
         *"k_cabinet_rk" => ""
         *"wardrobe_rk" => "Wooden Almirah"
         *"sofa_rk" => "One 3 seater and Two single seater with a center table and 5 cushions"
         *"dining_set_rk" => "6 seater Dinning set with cover"
         *"bed_rk" => "1 King Size, 1 Queen Size"
         *"mattress_rk" => "1 King Size, 1 Queen Size"
         *"g_stove_rk" => "With Induction"
         *"i_stove_rk" => ""
         *"Microwave_rk" => ""
         *"g_cylinder_rk" => ""
         *"e_fan_rk" => ""
         *"k_chimney_rk" => ""
         *"w_purifier_rk" => ""
         *"geyser_rk" => ""
         *"AC_rk" => "2 ton AC with remote, 1 ton inverter AC with remote"
         *"TV_rk" => "50” Micromax LED TV with Remote"
         *"fridge_rk" => "Single door Refrigerator"
         *"wc_rk" => ""
         *"inverter_rk" => ""
         *"s_table_rk" => ""
         *"sd_table_rk" => ""
         *"chair_rk" => ""
         *]
         */

        // $property_amenities = csvToArray('database/old_data/properties_society.csv');
        $property_amenities = csvToArray(base_path('database/old_data/properties_society.csv'));
        // Sample property amenities item in the array
        /**
         * array:14 [
         * "property_id" => "18"
         * "pet" => "0"
         * "bachelor" => "1"
         * "student" => "0"
         * "couple" => "0"
         * "family" => "1"
         * "parking" => "1"
         * "lift" => "1"
         * "power" => "0"
         * "security" => "1"
         * "swimming" => "1"
         * "gym" => "1"
         * "recreation" => "1"
         * "community" => "1"
         *]         
         */

        // $property_establishments = csvToArray('database/old_data/properties_nearby.csv');
        $property_establishments = csvToArray(base_path('database/old_data/properties_nearby.csv'));
        // Sample property establishments item in the array
        /**
         * array:49 [
         *"property_id" => "18"
         *"market_1" => "Sandhiram Boro Daily Market"
         *"market_2" => "Shahjahan Market"
         *"market_3" => "Reliance Market"
         *"hospital_1" => "Apollo Hospitals Guwahati"
         *"hospital_2" => "Guwahati Medical College Hospital"
         *"hospital_3" => "Sun Valley Hospital"
         *"school_1" => "Maria's Central Public School"
         *"school_2" => "Little Flower School"
         *"school_3" => "Axel Public School, Survey"
         *"atm_1" => "SBI"
         *"atm_2" => "UCO Bank"
         *"atm_3" => "Union Bank of India ATM"
         *"bank_1" => "UCO Bank"
         *"bank_2" => "Union Bank of India"
         *"bank_3" => "SBI"
         *"restaurant_1" => "ALOHI.. An Authentic Assamese Restaurant"
         *"restaurant_2" => "The Nawab's & Nizam's Kitchen"
         *"restaurant_3" => "Yoko Restaurant"
         *"movie_1" => "Carnival Cinemas"
         *"movie_2" => "Cinépolis Guwahati Central Mall"
         *"movie_3" => "PVR: Dona Planet"
         *"airport" => "Lokpriya Gopinath Bordoloi Airport"
         *"train" => "Guwahati Station"
         *"bus" => "ISBT"
         *"market_1_distance" => "1"
         *"market_2_distance" => "4"
         *"market_3_distance" => "4"
         *"hospital_1_distance" => "5.5"
         *"hospital_2_distance" => "7"
         *"hospital_3_distance" => "7"
         *"school_1_distance" => "1"
         *"school_2_distance" => "2"
         *"school_3_distance" => "3"
         *"atm_1_distance" => "1"
         *"atm_2_distance" => "1"
         *"atm_3_distance" => "2"
         *"bank_1_distance" => "1"
         *"bank_2_distance" => "2"
         *"bank_3_distance" => "1"
         *"restaurant_1_distance" => "1"
         *"restaurant_2_distance" => "1.8"
         *"restaurant_3_distance" => "2"
         *"movie_1_distance" => "3"
         *"movie_2_distance" => "6"
         *"movie_3_distance" => "6"
         *"airport_distance" => "26"
         *"train_distance" => "10.5"
         *"bus_distance" => "10"
         *]
         */

        // $property_images = csvToArray('database/old_data/properties_images.csv');
        $property_images = csvToArray(base_path('database/old_data/properties_images.csv'));
        // Sample property images item in the array
        /**
         * array:7 [
         *"id" => "47"
         *"property_id" => "19"
         *"image_url" => "https://dwelly.ap-south-1.linodeobjects.com/DWELLY_19_0.jpeg"
         *"cover" => "0"
         *"image_order" => "2"
         *"image_status" => "1"
         *"image_token" => "1"
         *]
         */

        // $localities = csvToArray('database/old_data/localities.csv');
        $localities = csvToArray(base_path('database/old_data/localities.csv'));
        // Sample locality item in the array
        /**
         * rray:4 [
         *"locality_id" => "1"
         *"pincode" => "781001"
         *"locality_name" => "Pan Bazar"
         *"locality_city" => "Guwahati"
         *]
         */


        // define array with old furniture name as key and new furniture name as value
        $furniture_names = [
            'k_cabinet' => 'Kitchen Cabinet',
            'dining_set' => 'Dining Set',
            'g_stove' => 'Gas Stove',
            'i_stove' => 'Induction Stove',
            'g_cylinder' => 'Gas Cylinder',
            'e_fan' => 'Exhaust Fan',
            'k_chimney' => 'Kitchen Chimney',
            'w_purifier' => 'Water Purifier',
            'AC' => 'Air Conditioner',
            'TV' => 'Television',
            'wc' => 'Washing Machine',
            's_table' => 'Study Table',
            'sd_table' => 'Side Table',
        ];

        //  Start the property data migration
        foreach ($properties as $property) {
            // get the resoective property_room
            $property_room = array_values(array_filter($property_rooms, function ($item) use ($property) {
                return $item['property_id'] == $property['property_id'];
            }));
            // Get the locality
            $locality = array_values(array_filter($localities, function ($item) use ($property) {
                return $item['locality_id'] == $property['locality'];
            }));

            // Get the respective property furniture
            $property_furniture = array_values(array_filter($property_furnitures, function ($item) use ($property) {
                return $item['property_id'] == $property['property_id'];
            }));

            // Get the respective property furniture description
            $property_furniture_description = array_values(array_filter($property_furniture_descriptions, function ($item) use ($property) {
                return $item['property_id'] == $property['property_id'];
            }));

            // Get the respective property amenities
            $property_amenity = array_values(array_filter($property_amenities, function ($item) use ($property) {
                return $item['property_id'] == $property['property_id'];
            }));

            // Get the respective property establishment
            $property_establishment = array_values(array_filter($property_establishments, function ($item) use ($property) {
                return $item['property_id'] == $property['property_id'];
            }));

            // Get the respective property images
            $property_image = array_values(array_filter($property_images, function ($item) use ($property) {
                return $item['property_id'] == $property['property_id'];
            }));

            // Find the locality in the DB by the pincode and get the id
            $locality_id = DB::table('localities')->where('pincode', $locality[0]['pincode'])->first()->id;
            // Check if the property code is already in the DB
            $property_code_exists = DB::table('properties')->where('code', $property['property_code'])->exists();

            // If the property code is in the DB suffix the property code with the property id
            if ($property_code_exists) {
                $property['property_code'] = $property['property_code'] . '_' . $property['property_id'];
            }

            //  Create the property
            $property = \App\Models\Property::create([
                'code' => $property['property_code'],
                'bhk' => $property['bhk'],
                'floor_space' => $property['floor_space'],
                'property_type_id' => $property['type'],
                'flooring_id' => $property['flooring'],
                'furnishing_id' => $property_room[0]['furnish'],

                'floors' => $property_room[0]['floor'],
                'total_floors' => $property_room[0]['floor_max'],

                'address' => $property['address'],
                'building_name' => $property['building'],
                'landmark' => $property['landmark'],
                'locality_id' => $locality_id,

                'latitude' => $property['latitude'],
                'longitude' => $property['longitude'],

                'rent' => $property['rent'],
                'securityDeposit' => $property['security_deposit'],
                'societyFee' => $property['society_fee'],
                'bookingAmount' => $property['booking_amt'],
                // 'rent_in_cents' => $property['rent'] * 100,
                // 'security_deposit_in_cents' => $property['security_deposit'] * 100,
                // 'society_fee_in_cents' => $property['society_fee'] * 100,
                // 'booking_amount_in_cents' => $property['booking_amt'] * 100,

                'is_promoted' => $property['vip'],

                'available_from' => $property['available_from'],

                'created_by' => User::first()->id,
            ]);

            //  Loop through $property_room and sync with the property with quantity in the pivot table
            foreach ($property_room[0] as $room => $quantity) {
                // if room is washroom change it to bathroom
                if ($room == 'washroom') {
                    $room = 'bathroom';
                }
                // check if there are room names like in the rooms table
                $room_exists = DB::table('rooms')->where('name', 'like', '%' . ucfirst($room) . '%')->exists();
                // If the room exists get the id
                if ($room_exists) {
                    $room_id = DB::table('rooms')->where('name', 'like', '%' . ucfirst($room) . '%')->first()->id;
                    // Sync the room with the property with the quantity
                    $property->rooms()->syncWithoutDetaching([$room_id => ['quantity' => $quantity]]);
                }
            }

            // Loop through the property furniture and sync with the property with quantity in the pivot table
            foreach ($property_furniture[0] as $furniture => $quantity) {
                // Get the furniture description by the furniture name suffix with _rk but excluding
                $furniture_description = '';
                if ($furniture != 'property_id') {
                    $furniture_description = $property_furniture_description[0][$furniture . '_rk'];
                }
                // Check if the furniture name is in the $furniture_names array
                if (array_key_exists($furniture, $furniture_names)) {
                    // get the new furniture name
                    $furniture = $furniture_names[$furniture];
                }

                // check if there are furniture names like in the furnitures table
                $furniture_exists = DB::table('furniture')->where('name', 'like', '%' . ucfirst($furniture) . '%')->exists();
                // If the furniture exists get the id
                if ($furniture_exists) {
                    $furniture_id = DB::table('furniture')->where('name', 'like', '%' . ucfirst($furniture) . '%')->first()->id;
                    // Sync the furniture with the property with the quantity and description
                    $property->furnitures()->syncWithoutDetaching([$furniture_id => ['quantity' => $quantity, 'description' => $furniture_description]]);
                }
            }

            // Loop through the property amenities and sync with the property
            foreach ($property_amenity[0] as $amenity => $value) {
                // check if there are amenity names like in the amenities table
                $amenity_exists = DB::table('amenities')->where('name', 'like', '%' . ucfirst($amenity) . '%')->exists();
                // If the amenity exists get the id
                if ($amenity_exists && $value == 1) {
                    $amenity_id = DB::table('amenities')->where('name', 'like', '%' . ucfirst($amenity) . '%')->first()->id;
                    // Sync the amenity with the property
                    $property->amenities()->syncWithoutDetaching([$amenity_id]);
                }
            }

            // Split the property establishment into 2 arrays one for the establishment and one for the establishment distances with suffix _distance
            $property_establishment_item = array_filter($property_establishment[0], function ($key) {
                return !str_contains($key, '_distance');
            }, ARRAY_FILTER_USE_KEY);

            // Remove property_id from the array
            unset($property_establishment_item['property_id']);
            $property_establishment_distance = array_filter($property_establishment[0], function ($key) {
                return str_contains($key, '_distance');
            }, ARRAY_FILTER_USE_KEY);

            // Loop through the property establishment and sync with the property
            foreach ($property_establishment_item as $establishment => $value) {
                // save the original establishment name
                $establishment_name = $establishment;
                // remove the anything after a _ in the establishment name
                $establishment = explode('_', $establishment)[0];
                // Change movie to theatre
                if ($establishment == 'movie') {
                    $establishment = 'theatre';
                }

                // check if there are establishment names like in the establishments table
                $establishment_type_exists = DB::table('establishment_types')->where('name', 'like', '%' . ucfirst($establishment) . '%')->exists();
                // If the establishment exists get the id
                if ($establishment_type_exists && $value != '') {
                    $establishment_type_id = DB::table('establishment_types')->where('name', 'like', '%' . ucfirst($establishment) . '%')->first()->id;
                    // Get the establishment distance
                    $establishment_distance = $property_establishment_distance[$establishment_name . '_distance'];

                    // Create a new nearby establishment with the establishment type id, property id, establishment description and distance in kms
                    $nearby_establishment = \App\Models\NearbyEstablishment::create([
                        'establishment_type_id' => $establishment_type_id,
                        'property_id' => $property->id,
                        'description' => $value,
                        'distance_in_kms' => $establishment_distance,
                    ]);
                }
            }

            /**
             * array:7 [
             *"id" => "47"
             *"property_id" => "19"
             *"image_url" => "https://dwelly.ap-south-1.linodeobjects.com/DWELLY_19_0.jpeg"
             *"cover" => "0"
             *"image_order" => "2"
             *"image_status" => "1"
             *"image_token" => "1"
             *]
             */

            // Loop through the property images and save them to the property
            foreach ($property_image as $image) {
                // download the image and save it as the property code with the image order in storage/app/public/uploads/properties
                $image_name = $property->code . '_' . $image['image_order'] . '.jpeg';
                $image_path = Storage::disk('public')->putFileAs('uploads/properties', $image['image_url'], $image_name);
                // Create a new property image with the property id, image path, cover and image order
                $property_image = \App\Models\PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $image_path,
                    'cover' => $image['cover'],
                    'image_order' => $image['image_order'],
                    'show' => $image['image_status'],
                ]);
            }
        }

        return ('Done');
    }
}
