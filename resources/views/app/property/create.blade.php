<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Property') }}
        </h2>
    </x-slot>

    <form action="{{ route('property.create') }}" method="POST">
        @csrf
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Property Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Property code --}}
                        <div>
                            <x-jet-label for="code" :value="__('Code')" />
                            <x-jet-input id="code" class="block mt-1 w-full" type="text" name="code"
                                value="{{ old('code') }}" />
                        </div>
                        {{-- Bhk --}}
                        <div>
                            <x-jet-label for="bhk" :value="__('BhK')" />
                            <x-input-select id="bhk" name="bhk">
                                @foreach ($bhks as $bhk)
                                    <option value="{{ $bhk->id }}">{{ $bhk->name }}</option>
                                @endforeach
                            </x-input-select>
                        </div>
                        {{-- Property Type --}}
                        <div>
                            <x-jet-label for="property_type_id" :value="__('Property Type')" />
                            <x-input-select id="property_type_id" name="property_type_id">
                                @foreach ($propertyTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </x-input-select>
                        </div>

                        {{-- FLoor space --}}
                        <div>
                            <x-jet-label for="floor_space" :value="__('Floor Space (SQ Ft)')" />
                            <x-jet-input id="floor_space" class="block mt-1 w-full" type="number" name="floor_space"
                                value="{{ old('floor_space') }}" />
                        </div>

                        {{-- Flooring --}}
                        <div>
                            <x-jet-label for="flooring_id" :value="__('Flooring')" />
                            <x-input-select id="flooring_id" name="flooring_id">
                                @foreach ($floorings as $flooring)
                                    <option value="{{ $flooring->id }}">{{ $flooring->name }}</option>
                                @endforeach
                            </x-input-select>
                        </div>

                        {{-- Furnishing --}}
                        <div>
                            <x-jet-label for="furnishing_id" :value="__('Furnishing')" />
                            <x-input-select id="furnishing_id" name="furnishing_id">
                                @foreach ($furnishings as $furnishing)
                                    <option value="{{ $furnishing->id }}">{{ $furnishing->name }}</option>
                                @endforeach
                            </x-input-select>
                        </div>

                        {{-- Floors --}}
                        <div>
                            <x-jet-label for="floors" :value="__('Floors')" />
                            <x-jet-input id="floors" class="block mt-1 w-full" type="number" name="floors"
                                value="{{ old('floors') }}" />
                        </div>

                        {{-- Total floors --}}
                        <div>
                            <x-jet-label for="total_floors" :value="__('Total Floors')" />
                            <x-jet-input id="total_floors" class="block mt-1 w-full" type="number" name="total_floors"
                                value="{{ old('total_floors') }}" />
                        </div>

                        {{-- Address --}}
                        <div class="col-span-3">
                            <x-jet-label for="address" :value="__('Address')" />
                            <x-textarea id="address" class="block mt-1 w-full" type="text" name="address">
                                {{ old('address') }}
                            </x-textarea>
                        </div>

                        {{-- Building name --}}
                        <div>
                            <x-jet-label for="building_name" :value="__('Building Name')" />
                            <x-jet-input id="building_name" class="block mt-1 w-full" type="text" name="building_name"
                                value="{{ old('building_name') }}" />
                        </div>

                        {{-- Landmark --}}
                        <div>
                            <x-jet-label for="landmark" :value="__('Landmark')" />
                            <x-jet-input id="landmark" class="block mt-1 w-full" type="text" name="landmark"
                                value="{{ old('landmark') }}" />
                        </div>

                        {{-- Locality --}}
                        <div>
                            <x-jet-label for="locality_id" :value="__('Locality')" />
                            <x-input-select id="locality_id" name="locality_id">
                                @foreach ($localities as $locality)
                                    <option value="{{ $locality->id }}">{{ $locality->name }}</option>
                                @endforeach
                            </x-input-select>
                        </div>

                        {{-- Latitude --}}
                        <div>
                            <x-jet-label for="latitude" :value="__('Latitude')" />
                            <x-jet-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                                value="{{ old('latitude') }}" />
                        </div>

                        {{-- Longitude --}}
                        <div>
                            <x-jet-label for="longitude" :value="__('Longitude')" />
                            <x-jet-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                                value="{{ old('longitude') }}" />
                        </div>

                        {{-- Rent --}}
                        <div class="md:col-start-1">
                            <x-jet-label for="rent" :value="__('Rent (₹)')" />
                            <x-jet-input id="rent" class="block mt-1 w-full" type="number" name="rent"
                                value="{{ old('rent') }}" />
                        </div>

                        {{-- Security deposit --}}
                        <div>
                            <x-jet-label for="security_deposit" :value="__('Security Deposit (₹)')" />
                            <x-jet-input id="security_deposit" class="block mt-1 w-full" type="number" name="security_deposit"
                                value="{{ old('security_deposit') }}" />
                        </div>

                        {{-- Society fee --}}
                        <div>
                            <x-jet-label for="society_fee" :value="__('Society Fee (₹)')" />
                            <x-jet-input id="society_fee" class="block mt-1 w-full" type="number" name="society_fee"
                                value="{{ old('society_fee') }}" />
                        </div>

                        {{-- Booking amount --}}
                        <div>
                            <x-jet-label for="booking_amount" :value="__('Booking Amount (₹)')" />
                            <x-jet-input id="booking_amount" class="block mt-1 w-full" type="number" name="booking_amount"
                                value="{{ old('booking_amount') }}" />
                        </div>

                        {{-- Is promoted --}}
                        <div>
                            <x-jet-label for="is_promoted" :value="__('Is Promoted (Min GTEE)')" />
                            <x-input-select id="is_promoted" name="is_promoted">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </x-input-select>
                        </div>

                        {{-- Available from --}}
                        <div>
                            <x-jet-label for="available_from" :value="__('Available From')" />
                            <x-jet-input id="available_from" class="block mt-1 w-full" type="date" name="available_from"
                                value="{{ old('available_from') }}" />
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
