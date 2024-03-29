<?php

namespace App\Http\Controllers\Property;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Property::class);
        return view('app.property.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $audit_id = $request->query('audit_id') ?? null;
        // return view('app.property.create', compact('audit_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $this->authorize('update', $property);

        $propertyTypes = \App\Models\PropertyType::all();
        $bhks = \App\Models\Bhk::all();
        $floorings = \App\Models\Flooring::all();
        $furnishings = \App\Models\Furnishing::all();
        $localities = \App\Models\Locality::all();

        $amenities = \App\Models\Amenity::all();
        $rooms = \App\Models\Room::all();
        $furnitures = \App\Models\Furniture::all();

        // Get the nearby establishments ordered by distance and grouped by type
        $nearbyEstablishments = $property->nearbyEstablishments()
            ->with('establishmentType')
            ->orderBy('distance_in_kms')
            ->get()
            ->groupBy('establishment_type_id');

        $propertyImages = $property->propertyImages()->orderBy('is_cover', 'desc')->orderBy('order', 'desc')->get();

        return view('app.property.edit', compact(
            'property',
            'propertyTypes',
            'bhks',
            'floorings',
            'furnishings',
            'localities',

            'amenities',
            'rooms',
            'furnitures',
            'nearbyEstablishments',

            'propertyImages'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
