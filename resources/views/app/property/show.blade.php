<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Property Details') }}
        </h2>
    </x-slot>

    {{-- Property Details --}}
    @livewire('property.property-details', ['property' => $property])

    {{-- Amenities --}}
    @livewire('property.property-amenities', ['property' => $property])


    {{-- Rooms --}}
    @livewire('property.property-rooms', ['property' => $property])

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
