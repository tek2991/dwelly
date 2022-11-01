<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Property Details') }}
        </h2>
    </x-slot>

    {{-- Property Details --}}
    @livewire('property.property-details', ['property' => $property])

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex justify-between mb-6">
                    <div>
                        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Owner</h2>
                        @if ($property->owner())
                            @php
                                $owner = $property->owner();
                            @endphp
                            <div>
                                <x-jet-label for="code" :value="__('Code')" />
                                <x-jet-input id="code" class="block mt-1 w-full" type="text" value="test"
                                    disabled />
                            </div>
                        @else
                            <div class="flex items-center">
                                <h2 class="font-semibold text-lg text-red-800 leading-tight">
                                    {{ __('No Owner found!') }}
                                </h2>
                                <x-button-link href="{{ route('owner.create', $property) }}" class="ml-4">
                                    {{ __('Create') }}
                                </x-button-link>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

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
        @livewire('property.property-images', ['property' => $property])
</x-app-layout>
