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
    @livewire('property.property-furnitures', ['property' => $property])

    {{-- Nearby Establishments --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex justify-between mb-6">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Nearby Establishments</h2>
                    <x-jet-button
                        onclick="Livewire.emit('openModal', 'property.attach-nearby-establishment-modal', {{ json_encode(['property_id' => $property->id]) }})"
                        class="cursor-pointer">Add New</x-jet-button>
                </div>
                <livewire:property.property-nearby-establishment-table property_id="{{ $property->id }}" />
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
