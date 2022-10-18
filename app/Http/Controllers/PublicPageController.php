<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Locality;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PublicPageController extends Controller
{
    public function index()
    {
        // Get the latest 6 properties
        $properties = Property::where('is_available', true)->latest()->take(6)->get();
        return view('public.index', compact('properties'));
    }

    public function allProperties(Request $request)
    {
        // Get the bhks
        $bhks = DB::table('bhks')->get();

        // Get the amenities with suffix _frienly in the name
        $amenities = DB::table('amenities')->where('name', 'like', '%_friendly')->get();

        // Get the property types for Apartment and House
        $propertyTypes = DB::table('property_types')->whereIn('name', ['Apartment', 'House'])->get();

        // Get the Furnishings
        $furnishings = DB::table('furnishings')->get();

        // Get the amenities for Lift, Parking, Power Backup, Security, and Swimming Pool
        $amenities2 = DB::table('amenities')->whereIn('name', ['Lift', 'Parking', 'Power Backup', 'Security', 'Swimming Pool'])->get();

        // Get the localities
        $localities = Locality::whereHas('properties')->get();

        // declare an object to store the filters
        $filters = new \stdClass();
        // Declare empty arrays for each filter
        $filters->bhks = [];
        $filters->amenities = [];
        $filters->propertyTypes = [];
        $filters->furnishings = [];
        $filters->localities = [];

        // Check the filters from the request, if any and store them in the object
        if ($request->has('bhks')) {
            $filters->bhks = $request->input('bhks');
        }
        if ($request->has('amenities')) {
            $filters->amenities = $request->input('amenities');
        }
        if ($request->has('propertyTypes')) {
            $filters->propertyTypes = $request->input('propertyTypes');
        }
        if ($request->has('furnishings')) {
            $filters->furnishings = $request->input('furnishings');
        }
        if ($request->has('localities')) {
            $filters->localities = $request->input('localities');
        }

        // Get the search query from the request
        $searchQuery = $request->input('query');

        // Get the properties
        $properties = Property::search($searchQuery)
            ->when($filters->bhks, function ($query, $bhks) {
                return $query->whereIn('bhk_id', $bhks);
            })
            ->when($filters->amenities, function ($query, $amenities) {
                // Get the amenities names
                $amenitiesNames = DB::table('amenities')->whereIn('id', $amenities)->pluck('name');
                // Check for each amenity
                foreach ($amenitiesNames as $amenity) {
                    return $query->where("'" . $amenity . "'", 'true');
                }
            })
            ->when($filters->propertyTypes, function ($query, $propertyTypes) {
                return $query->whereIn('property_type_id', $propertyTypes);
            })
            ->when($filters->furnishings, function ($query, $furnishings) {
                return $query->whereIn('furnishing_id', $furnishings);
            })
            ->when($filters->localities, function ($query, $localities) {
                return $query->whereIn('locality_id', $localities);
            })
            ->when($request->input('sortBy'), function ($query, $sortBy) {
                if ($sortBy === 'price_asc') {
                    return $query->orderBy('rent');
                }
                if ($sortBy === 'price_desc') {
                    return $query->orderBy('rent', 'desc');
                }
                if ($sortBy === 'recomended') {
                    return $query->orderBy('id', 'desc');
                }
            })
            ->when(!$request->input('sortBy'), function ($query, $sortBy) {
                return $query->orderBy('id', 'desc');
            })
            ->paginate(10)
            ->withQueryString();

        // dd($filters);

        return view('public.allProperties', compact('properties', 'bhks', 'amenities', 'propertyTypes', 'furnishings', 'amenities2', 'localities', 'filters', 'request'));
    }

    public function viewProperty(Property $property)
    {
        $primaryRooms = \App\Models\Room::primaryRooms();
        // Get the property's furnitures which has an icon_path and where show is true
        $furnitures = $property->furnitures()->where('icon_path', '!=', null)->where('show', true)->get();
        // Get the amenities which has an icon_path and does not have the word friendly in the name
        $amenities = \App\Models\Amenity::where('icon_path', '!=', null)->where('show', true)->where('name', 'not like', '%_friendly')->get();
        // Get the amenities which has an icon_path and has the word friendly in the name
        $amenities2 = \App\Models\Amenity::where('icon_path', '!=', null)->where('show', true)->where('name', 'like', '%_friendly')->get();
        // Get the properties nearby establishments
        $nearbyEstablishments = $property->nearbyEstablishments()
            ->with('establishmentType')
            ->orderBy('distance_in_kms')
            ->get()
            ->groupBy('establishment_type_id');

        $propertyImages = $property->propertyImages()->orderBy('order', 'asc')->get();

        return view('public.viewProperty', compact('property', 'primaryRooms', 'furnitures', 'amenities', 'amenities2', 'nearbyEstablishments', 'propertyImages'));
    }

    public function propertyBrocure(Property $property)
    {
        $coverImage = $property->coverImage;
        $coverImage = Image::make(storage_path('app/public/' . $coverImage->image_path))->resize(640, 480, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('data-url');

        $first3images = $property->propertyImages()->where('is_cover', false)->where('show', true)->take(3)->get();
        $images = [];
        foreach ($first3images as $image) {
            $images[] = Image::make(storage_path('app/public/' . $image->image_path))->resize(480, 320, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('data-url');
        }

        $nearbyEstablishments = $property->nearbyEstablishments()
            ->with('establishmentType')
            ->orderBy('distance_in_kms')
            ->get()
            ->groupBy('establishment_type_id');

        $pdf = PDF::loadView('pdf.propertyBrochure', compact('property', 'coverImage', 'images', 'nearbyEstablishments'));
        $filename = $property->code . '_Brochure.pdf';
        return $pdf->download($filename);
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
}
