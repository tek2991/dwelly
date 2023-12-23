<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResetIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'icons:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Reset the icons in the DB and storage";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Icons to reset -> Furnitures, Ammenities, and Establishment Types

        // Set the $updated and $notUpdated variables
        $updated = '';
        $notUpdated = '';

        // Furnitures
        $furnitures = DB::table('furniture')->get();

        // Get icons from storage/default_icons/Furniture inside the storage folder
        $icons = Storage::files('default_icons/Furniture');

        // Print the number of icons found
        $this->info(count($icons) . ' icons found in storage/default_icons/Furniture');

        // Loop through the furnitures
        foreach ($furnitures as $furniture) {
            // Find the icon in the icons array with the same name as the furniture name and return the path
            $icon = array_filter($icons, function ($icon) use ($furniture) {
                return strpos($icon, $furniture->name) !== false;
            });

            // If the icon exists, copy it to uploads/icons/furniture
            if (count($icon) > 0) {
                $icon = array_values($icon)[0];
                $path = Storage::disk('local')->path($icon);
                $newPath = Storage::disk('public')->path('uploads/icons/furniture/' . basename($icon));
                // If path does not exist, create the directory
                if (!file_exists(dirname($newPath))) {
                    mkdir(dirname($newPath), 0777, true);
                }
                copy($path, $newPath);

                // Update the icon_path column in the furniture table
                DB::table('furniture')->where('id', $furniture->id)->update([
                    'icon_path' => 'uploads/icons/furniture/' . basename($icon),
                    'show' => '1'
                ]);
                $updated .= $furniture->name . ', ';
            } else {
                $notUpdated .= $furniture->name . ', ';
            }
        }

        // Print the number of furnitures updated
        $this->info(count(explode(', ', $updated)) - 1 . ' furnitures updated');
        $this->info(count(explode(', ', $notUpdated)) - 1 . ' furnitures not updated');

        // Reset the $updated and $notUpdated variables
        $updated = '';
        $notUpdated = '';

        // Amenities
        $amenities = DB::table('amenities')->get();

        // Get icons from storage/default_icons/Amenity inside the storage folder
        $icons = Storage::files('default_icons/Amenity');

        // Print the number of icons found
        $this->info(count($icons) . ' icons found in storage/default_icons/Amenity');

        // Loop through the amenities
        foreach ($amenities as $amenity) {
            // Find the icon in the icons array with the same name as the amenity name and return the path
            $icon = array_filter($icons, function ($icon) use ($amenity) {
                return strpos($icon, $amenity->name) !== false;
            });

            // If the icon exists, copy it to uploads/icons/amenity
            if (count($icon) > 0) {
                $icon = array_values($icon)[0];
                $path = Storage::disk('local')->path($icon);
                $newPath = Storage::disk('public')->path('uploads/icons/amenities/' . basename($icon));
                // If path does not exist, create the directory
                if (!file_exists(dirname($newPath))) {
                    mkdir(dirname($newPath), 0777, true);
                }
                copy($path, $newPath);

                // Update the icon_path column in the amenities table
                DB::table('amenities')->where('id', $amenity->id)->update([
                    'icon_path' => 'uploads/icons/amenities/' . basename($icon),
                    'show' => '1'
                ]);
                $updated .= $amenity->name . ', ';
            } else {
                $notUpdated .= $amenity->name . ', ';
            }
        }

        // Print the number of amenities updated
        $this->info(count(explode(', ', $updated)) - 1 . ' amenities updated');
        $this->info(count(explode(', ', $notUpdated)) - 1 . ' amenities not updated');

        // Reset the $updated and $notUpdated variables
        $updated = '';
        $notUpdated = '';

        // Establishment Types
        $establishmentTypes = DB::table('establishment_types')->get();

        // Get icons from storage/default_icons/EstablishmentType inside the storage folder
        $icons = Storage::files('default_icons/EstablishmentType');

        // Print the number of icons found
        $this->info(count($icons) . ' icons found in storage/default_icons/EstablishmentType');

        // Loop through the establishment types
        foreach ($establishmentTypes as $establishmentType) {
            // Find the icon in the icons array with the same name as the establishment type name and return the path
            $icon = array_filter($icons, function ($icon) use ($establishmentType) {
                return strpos($icon, $establishmentType->name) !== false;
            });

            // If the icon exists, copy it to uploads/icons/establishment_type
            if (count($icon) > 0) {
                $icon = array_values($icon)[0];
                $path = Storage::disk('local')->path($icon);
                $newPath = Storage::disk('public')->path('uploads/icons/establishment_type/' . basename($icon));
                // If path does not exist, create the directory
                if (!file_exists(dirname($newPath))) {
                    mkdir(dirname($newPath), 0777, true);
                }
                copy($path, $newPath);

                // Update the icon_path column in the establishment_types table
                DB::table('establishment_types')->where('id', $establishmentType->id)->update([
                    'icon_path' => 'uploads/icons/establishment_type/' . basename($icon),
                ]);
                $updated .= $establishmentType->name . ', ';
            } else {
                $notUpdated .= $establishmentType->name . ', ';
            }
        }

        // Print the number of establishment types updated
        $this->info(count(explode(', ', $updated)) - 1 . ' establishment types updated');
        $this->info(count(explode(', ', $notUpdated)) - 1 . ' establishment types not updated');

        // Success message
        $this->info('Icons reset successfully!');
    }
}
