<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Property Details</h2>
            <form wire:submit.prevent="store">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Property code --}}
                    <div>
                        <x-jet-label for="code" :value="__('Code')" />
                        @error('code')
                            <label for="code" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="code" class="block mt-1 w-full" type="text" wire:model="code" />
                    </div>
                    {{-- Is available --}}
                    <div>
                        <x-jet-label for="is_available" :value="__('Is Available(Vacant)')" />
                        @error('is_available')
                            <label for="is_available" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="is_available" wire:model="is_available">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </x-input-select>
                    </div>
                    {{-- Bhk --}}
                    <div>
                        <x-jet-label for="bhk_id" :value="__('BHK')" />
                        @error('bhk')
                            <label for="bhk_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="bhk_id" wire:model="bhk_id">
                            @foreach ($bhks as $bhk)
                                <option value="{{ $bhk->id }}">{{ $bhk->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>

                    {{-- Property Type --}}
                    <div>
                        <x-jet-label for="property_type_id" :value="__('Property Type')" />
                        @error('property_type')
                            <label for="property_type_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="property_type_id" wire:model="property_type_id">
                            @foreach ($propertyTypes as $propertyType)
                                <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>


                    {{-- FLoor space --}}
                    <div>
                        <x-jet-label for="floor_space" :value="__('Floor Space (sq. ft)')" />
                        @error('floor_space')
                            <label for="floor_space" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="floor_space" class="block mt-1 w-full" type="text"
                            wire:model="floor_space" />
                    </div>


                    {{-- Flooring --}}
                    <div>
                        <x-jet-label for="flooring_id" :value="__('Flooring')" />
                        @error('flooring')
                            <label for="flooring_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="flooring_id" wire:model="flooring_id">
                            @foreach ($floorings as $flooring)
                                <option value="{{ $flooring->id }}">{{ $flooring->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>


                    {{-- Furnishing --}}
                    <div>
                        <x-jet-label for="furnishing_id" :value="__('Furnishing')" />
                        @error('furnishing')
                            <label for="furnishing_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="furnishing_id" wire:model="furnishing_id">
                            @foreach ($furnishings as $furnishing)
                                <option value="{{ $furnishing->id }}">{{ $furnishing->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>



                    {{-- Floors --}}
                    <div>
                        <x-jet-label for="floors" :value="__('Floors')" />
                        @error('floors')
                            <label for="floors" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="floors" class="block mt-1 w-full" type="text"
                            wire:model="floors" />
                    </div>


                    {{-- Total floors --}}
                    <div>
                        <x-jet-label for="total_floors" :value="__('Total Floors')" />
                        @error('total_floors')
                            <label for="total_floors" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="total_floors" class="block mt-1 w-full" type="text"
                            wire:model="total_floors" />
                    </div>


                    {{-- Address --}}
                    <div class="col-span-3">
                        <x-jet-label for="address" :value="__('Address')" />
                        @error('address')
                            <label for="address" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-textarea id="address" class="block mt-1 w-full" type="text"
                            wire:model="address" />
                    </div>


                    {{-- Building name --}}
                    <div>
                        <x-jet-label for="building_name" :value="__('Building Name')" />
                        @error('building_name')
                            <label for="building_name" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="building_name" class="block mt-1 w-full" type="text"
                            wire:model="building_name" />
                    </div>


                    {{-- Landmark --}}
                    <div>
                        <x-jet-label for="landmark" :value="__('Landmark')" />
                        @error('landmark')
                            <label for="landmark" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="landmark" class="block mt-1 w-full" type="text"
                            wire:model="landmark" />
                    </div>


                    {{-- Locality --}}
                    <div>
                        <x-jet-label for="locality_id" :value="__('Locality')" />
                        @error('locality')
                            <label for="locality_id" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="locality_id" wire:model="locality_id">
                            @foreach ($localities as $locality)
                                <option value="{{ $locality->id }}">{{ $locality->name }}</option>
                            @endforeach
                        </x-input-select>
                    </div>


                    {{-- Latitude --}}
                    <div>
                        <x-jet-label for="latitude" :value="__('Latitude')" />
                        @error('latitude')
                            <label for="latitude" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="latitude" class="block mt-1 w-full" type="text"
                            wire:model="latitude" />
                    </div>


                    {{-- Longitude --}}
                    <div>
                        <x-jet-label for="longitude" :value="__('Longitude')" />
                        @error('longitude')
                            <label for="longitude" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="longitude" class="block mt-1 w-full" type="text"
                            wire:model="longitude" />
                    </div>


                    {{-- Link to Google maps --}}
                    <div class="flex items-end pb-2">
                        <a href="{{ $google_maps_link }}" class="text-blue-700 hover:underline font-semibold"
                            target="_blank">Open in Google Maps</a>
                    </div>


                    {{-- Rent --}}
                    <div>
                        <x-jet-label for="rent" :value="__('Rent')" />
                        @error('rent')
                            <label for="rent" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="rent" class="block mt-1 w-full" type="text"
                            wire:model="rent" />
                    </div>


                    {{-- Security deposit --}}
                    <div>
                        <x-jet-label for="security_deposit" :value="__('Security Deposit')" />
                        @error('security_deposit')
                            <label for="security_deposit" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="security_deposit" class="block mt-1 w-full" type="text"
                            wire:model="security_deposit" />
                    </div>


                    {{-- Society fee --}}
                    <div>
                        <x-jet-label for="society_fee" :value="__('Society Fee')" />
                        @error('society_fee')
                            <label for="society_fee" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="society_fee" class="block mt-1 w-full" type="text"
                            wire:model="society_fee" />
                    </div>


                    {{-- Booking amount --}}
                    <div>
                        <x-jet-label for="booking_amount" :value="__('Booking Amount')" />
                        @error('booking_amount')
                            <label for="booking_amount" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="booking_amount" class="block mt-1 w-full" type="text"
                            wire:model="booking_amount" />
                    </div>


                    {{-- Is promoted --}}
                    <div>
                        <x-jet-label for="is_promoted" :value="__('Is Promoted')" />
                        @error('is_promoted')
                            <label for="is_promoted" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-input-select id="is_promoted" wire:model="is_promoted">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </x-input-select>
                    </div>


                    {{-- Available from --}}
                    <div>
                        <x-jet-label for="available_from" :value="__('Available From')" />
                        @error('available_from')
                            <label for="available_from" class="text-xs text-red-700 block">{{ $message }}</label>
                        @enderror
                        <x-jet-input id="available_from" class="block mt-1 w-full" type="date"
                            wire:model="available_from" />
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <x-jet-button class="ml-4" type="submit">
                        {{ __('Save') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</div>
