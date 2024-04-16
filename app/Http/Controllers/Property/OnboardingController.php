<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Onboarding;
use App\Models\Property;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.onboarding.index');
    }

    public function propertyCreate()
    {
        $this->authorize('create', Onboarding::class);
        return view('app.onboarding.property-create');
    }
    public function propertyUpdate(Property $property)
    {
        $onboarding = Onboarding::where('property_id', $property->id)->first();
        $this->authorize('update', $onboarding);
        return view('app.onboarding.property-update', compact('property'));
    }

    public function ownerCreate(Property $property)
    {
        $onboarding = Onboarding::where('property_id', $property->id)->first();
        $this->authorize('update', $onboarding);
        return view('app.onboarding.owner-create', compact('property'));
    }
    public function ownerUpdate(Property $property)
    {
        $onboarding = Onboarding::where('property_id', $property->id)->first();
        $this->authorize('update', $onboarding);
        return view('app.onboarding.owner-update', compact('property'));
    }

    public function amenitiesUpdate(Property $property)
    {
        $onboarding = Onboarding::where('property_id', $property->id)->first();
        $this->authorize('update', $onboarding);
        return view('app.onboarding.amenities-update', compact('property'));
    }

    public function roomsUpdate(Property $property)
    {
        $onboarding = Onboarding::where('property_id', $property->id)->first();
        $this->authorize('update', $onboarding);
        return view('app.onboarding.rooms-update', compact('property'));
    }

    public function furnituresUpdate(Property $property)
    {
        $onboarding = Onboarding::where('property_id', $property->id)->first();
        $this->authorize('update', $onboarding);
        return view('app.onboarding.furnitures-update', compact('property'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Http\Response
     */
    public function show(Onboarding $onboarding)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Http\Response
     */
    public function edit(Onboarding $onboarding)
    {
        $this->authorize('update', $onboarding);
        return view('app.onboarding.edit', compact('onboarding'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Onboarding $onboarding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Onboarding  $onboarding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Onboarding $onboarding)
    {
        //
    }
}
