<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Property Details') }}
        </h2>
    </x-slot>

    {{-- Property Details --}}
    @livewire('property.property-details', ['property' => $property])

    {{-- Owner --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="mb-6">
                    <div>
                        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">Owner</h2>
                        @if ($property->owner())
                            @php
                                $user = $property->owner();
                                $owner = App\Models\Owner::where('user_id', $user->id)
                                    ->where('property_id', $property->id)
                                    ->first();
                            @endphp
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-jet-label for="name" :value="__('Name')" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text"
                                        value="{{ $user->name }}" disabled />
                                </div>
                                <div>
                                    <x-jet-label for="email" :value="__('Email')" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email"
                                        value="{{ $user->email }}" disabled />
                                </div>
                                <div>
                                    <x-jet-label for="phone_1" :value="__('Phone')" />
                                    <x-jet-input id="phone_1" class="block mt-1 w-full" type="text"
                                        value="{{ $user->phone_1 }}" disabled />
                                </div>
                                <div>
                                    <x-jet-label for="phone_2" :value="__('Phone Alternate')" />
                                    <x-jet-input id="phone_2" class="block mt-1 w-full" type="text"
                                        value="{{ $user->phone_2 }}" disabled />
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <x-button-link href="{{ route('owner.show', $owner) }}">
                                    {{ __('Details') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
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

        {{-- Tenants --}}
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-between mb-6">
                        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">All Tenants</h2>
                        <x-button-link href="{{ route('tenant.create', $property) }}" class="ml-4">
                            {{ __('Create New') }}
                        </x-button-link>
                    </div>
                    <livewire:tenant-table property_id="{{ $property->id }}" />
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
