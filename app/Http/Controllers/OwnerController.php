<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Owner;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.owner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        // Check if property has an owner
        if ($property->owner()) {
            return redirect()->route('property.show', $property)->dangerBanner('This property already has an owner.');
        }
        return view('app.owner.create', compact('property'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_1' => 'required|string|max:25',
            'phone_2' => 'nullable|string|max:25',
            'password' => 'required|string|min:8|confirmed',
            'onboarded_at' => 'required|date',

            'beneficiary_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'ifsc' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',

            'electricity_consumer_id_old' => 'nullable|string|max:255',
            'electricity_consumer_id_new' => 'nullable|string|max:255',
        ]);

        // Check if property has an owner
        $property = Property::find($validated['property_id']);
        if ($property->owner()) {
            return redirect()->route('property.show', $property)->dangerBanner('This property already has an owner.');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone_1' => $validated['phone_1'],
            'phone_2' => $validated['phone_2'],
        ]);

        $user->assignRole('owner');

        $owner = Owner::create([
            'user_id' => $user->id,
            'property_id' => $validated['property_id'],
            'onboarded_at' => $validated['onboarded_at'],

            'beneficiary_name' => $validated['beneficiary_name'],
            'bank_name' => $validated['bank_name'],
            'ifsc' => $validated['ifsc'],
            'account_number' => $validated['account_number'],

            'electricity_consumer_id_old' => $validated['electricity_consumer_id_old'],
            'electricity_consumer_id_new' => $validated['electricity_consumer_id_new'],
        ]);

        return redirect()->route('owner.show', $owner)->banner('Owner created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        return view('app.owner.show', compact('owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
    }
}
