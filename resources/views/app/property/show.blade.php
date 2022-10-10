<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Property Details') }}
        </h2>
    </x-slot>

    {{-- Property Details --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Property Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Property code --}}
                    <div>
                        <x-jet-label for="code" :value="__('Code')" />
                        <x-jet-input id="code" class="block mt-1 w-full" type="text" name="code" disabled
                            value="{{ $property->code }}" />
                    </div>
                    {{-- Is available --}}
                    <div>
                        <x-jet-label for="is_available" :value="__('Is Available(Vacant)')" />
                        <x-input-select id="is_available" name="is_available" disabled>
                            <option value="0" {{ $property->is_available == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $property->is_available == '1' ? 'selected' : '' }}>Yes</option>
                        </x-input-select>
                    </div>
                    {{-- Bhk --}}
                    <div>
                        <x-jet-label for="bhk" :value="__('BhK')" />
                        <x-input-select id="bhk" name="bhk" disabled>
                            @foreach ($bhks as $bhk)
                                <option value="{{ $bhk->id }}"
                                    {{ $bhk->id == $property->bhk_id ? 'selected' : '' }}>{{ $bhk->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>
                    {{-- Property Type --}}
                    <div>
                        <x-jet-label for="property_type_id" :value="__('Property Type')" />
                        <x-input-select id="property_type_id" name="property_type_id" disabled>
                            @foreach ($propertyTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ $type->id == $property->property_type_id ? 'selected' : '' }}>{{ $type->name }}
                                </option>
                            @endforeach
                        </x-input-select>
                    </div>

                    {{-- FLoor space --}}
                    <div>
                        <x-jet-label for="floor_space" :value="__('Floor Space (SQ Ft)')" />
                        <x-jet-input id="floor_space" class="block mt-1 w-full" type="number" name="floor_space"
                            value="{{ $property->floor_space }}" disabled />
                    </div>

                    {{-- Flooring --}}
                    <div>
                        <x-jet-label for="flooring_id" :value="__('Flooring')" />
                        <x-input-select id="flooring_id" name="flooring_id" disabled>
                            @foreach ($floorings as $flooring)
                                <option value="{{ $flooring->id }}"
                                    {{ $flooring->id == $property->flooring_id ? 'selected' : '' }}>
                                    {{ $flooring->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>

                    {{-- Furnishing --}}
                    <div>
                        <x-jet-label for="furnishing_id" :value="__('Furnishing')" />
                        <x-input-select id="furnishing_id" name="furnishing_id" disabled>
                            @foreach ($furnishings as $furnishing)
                                <option value="{{ $furnishing->id }}"
                                    {{ $furnishing->id == $property->furnishing_id ? 'selected' : '' }}>
                                    {{ $furnishing->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>

                    {{-- Floors --}}
                    <div>
                        <x-jet-label for="floors" :value="__('Floors')" />
                        <x-jet-input id="floors" class="block mt-1 w-full" type="number" name="floors"
                            value="{{ $property->floors }}" disabled />
                    </div>

                    {{-- Total floors --}}
                    <div>
                        <x-jet-label for="total_floors" :value="__('Total Floors')" />
                        <x-jet-input id="total_floors" class="block mt-1 w-full" type="number" name="total_floors"
                            value="{{ $property->total_floors }}" disabled />
                    </div>

                    {{-- Address --}}
                    <div class="md:col-span-3">
                        <x-jet-label for="address" :value="__('Address')" />
                        <x-textarea id="address" class="block mt-1 w-full" type="text" name="address" disabled>
                            {{ $property->address }}
                        </x-textarea>
                    </div>

                    {{-- Building name --}}
                    <div>
                        <x-jet-label for="building_name" :value="__('Building Name')" />
                        <x-jet-input id="building_name" class="block mt-1 w-full" type="text" name="building_name"
                            value="{{ $property->building_name }}" disabled />
                    </div>

                    {{-- Landmark --}}
                    <div>
                        <x-jet-label for="landmark" :value="__('Landmark')" />
                        <x-jet-input id="landmark" class="block mt-1 w-full" type="text" name="landmark"
                            value="{{ $property->landmark }}" disabled />
                    </div>

                    {{-- Locality --}}
                    <div>
                        <x-jet-label for="locality_id" :value="__('Locality')" />
                        <x-input-select id="locality_id" name="locality_id" disabled>
                            @foreach ($localities as $locality)
                                <option value="{{ $locality->id }}"
                                    {{ $locality->id == $property->locality_id ? 'selected' : '' }}>
                                    {{ $locality->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>

                    {{-- Latitude --}}
                    <div>
                        <x-jet-label for="latitude" :value="__('Latitude')" />
                        <x-jet-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                            value="{{ $property->latitude }}" disabled />
                    </div>

                    {{-- Longitude --}}
                    <div>
                        <x-jet-label for="longitude" :value="__('Longitude')" />
                        <x-jet-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                            value="{{ $property->longitude }}" disabled />
                    </div>

                    {{-- Link to Google maps --}}

                    <div class="flex items-center">
                        <a class="text-blue-800 hover:underline pt-6"
                            href="https://www.google.com/maps/search/?api=1&query={{ $property->latitude }},{{ $property->longitude }}"
                            target="_blank">
                            Open in Google Maps
                        </a>
                    </div>

                    {{-- Rent --}}
                    <div class="md:col-start-1">
                        <x-jet-label for="rent" :value="__('Rent (₹)')" />
                        <x-jet-input id="rent" class="block mt-1 w-full" type="number" name="rent"
                            value="{{ $property->rent }}" disabled />
                    </div>

                    {{-- Security deposit --}}
                    <div>
                        <x-jet-label for="security_deposit" :value="__('Security Deposit (₹)')" />
                        <x-jet-input id="security_deposit" class="block mt-1 w-full" type="number"
                            name="security_deposit" value="{{ $property->securityDeposit }}" disabled />
                    </div>

                    {{-- Society fee --}}
                    <div>
                        <x-jet-label for="society_fee" :value="__('Society Fee (₹)')" />
                        <x-jet-input id="society_fee" class="block mt-1 w-full" type="number" name="society_fee"
                            value="{{ $property->societyFee }}" disabled />
                    </div>

                    {{-- Booking amount --}}
                    <div>
                        <x-jet-label for="booking_amount" :value="__('Booking Amount (₹)')" />
                        <x-jet-input id="booking_amount" class="block mt-1 w-full" type="number"
                            name="booking_amount" value="{{ $property->bookingAmount }}" disabled />
                    </div>

                    {{-- Is promoted --}}
                    <div>
                        <x-jet-label for="is_promoted" :value="__('Is Promoted (Min GTEE)')" />
                        <x-input-select id="is_promoted" name="is_promoted" disabled>
                            <option value="0" {{ $property->is_promoted == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $property->is_promoted == '1' ? 'selected' : '' }}>Yes</option>
                        </x-input-select>
                    </div>

                    {{-- Available from --}}
                    <div>
                        <x-jet-label for="available_from" :value="__('Available From')" />
                        <x-jet-input id="available_from" class="block mt-1 w-full" type="text"
                            name="available_from" value="{{ $property->available_from->format('d-m-Y') }}"
                            disabled />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Amenities --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Amenities</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($amenities as $aminity)
                        <div>
                            <x-jet-label for="amenity_{{ $aminity->id }}" :value="__($aminity->name)" />
                            <x-input-select id="amenity_{{ $aminity->id }}" name="amenity_{{ $aminity->id }}"
                                disabled>
                                <option value="0"
                                    {{ $property->amenities->contains($aminity->id) ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ $property->amenities->contains($aminity->id) ? 'selected' : '' }}>
                                    Yes</option>
                            </x-input-select>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Rooms --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Rooms</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($rooms as $room)
                        <div>
                            <x-jet-label for="room_{{ $room->id }}" :value="__($room->name)" />
                            <x-jet-input id="room_{{ $room->id }}" class="block mt-1 w-full" type="number"
                                name="room_{{ $room->id }}"
                                value="{{ $property->rooms->contains($room->id) ? $property->rooms->find($room->id)->pivot->quantity : 0 }}"
                                disabled />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Furnitures --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Furnishing</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($furnitures as $furniture)
                        <div>
                            <x-jet-label for="furniture_{{ $furniture->id }}" :value="__($furniture->name)" />
                            <x-jet-input id="furniture_{{ $furniture->id }}" class="block mt-1 w-full"
                                type="number" name="furniture_{{ $furniture->id }}"
                                value="{{ $property->furnitures->contains($furniture->id) ? $property->furnitures->find($furniture->id)->pivot->quantity : 0 }}"
                                disabled />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Nearby Establishments --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Nearby Establishments</h2>
                @foreach ($nearbyEstablishments as $nearbyEstablishmentTypes)
                <div class="pt-4">
                    <h2 class="my-2 font-bold text-lg text-gray-800 leading-tight">
                        {{ $nearbyEstablishmentTypes->first()->establishmentType->name }}
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-b-2">
                        @foreach ($nearbyEstablishmentTypes as $nearbyEstablishment)
                            <div>
                                <p>
                                    {{ $nearbyEstablishment->description }}
                                </p>
                                <p>
                                    {{ $nearbyEstablishment->distance_in_kms }} kms
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Images --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Images</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($propertyImages as $image)
                        <div>
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="property Image">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
