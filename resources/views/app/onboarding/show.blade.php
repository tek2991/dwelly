<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Property Onboarding') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Property Details --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold">Property Details</h3>
                        <p class="text-sm {{ $onboarding->property_data ? 'text-green-500' : 'text-orange-700' }}">
                            {{ $onboarding->property_data ? 'Completed' : 'Pending' }}</p>
                    </div>
                    <div class="flex justify-end pt-6">
                        @if ($onboarding->completed)
                            Editing Locked!
                        @else
                            @if ($onboarding->property_data)
                                <x-button-link href="{{ route('onboarding.property.update', $onboarding->property) }}">
                                    {{ __('Edit') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @else
                                <x-button-link href="{{ route('onboarding.property.create') }}">
                                    {{ __('Create') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Owner Detail --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold">Owner Details</h3>
                        <p class="text-sm {{ $onboarding->owner_data ? 'text-green-500' : 'text-orange-700' }}">
                            {{ $onboarding->owner_data ? 'Completed' : 'Pending' }}</p>
                    </div>
                    <div class="flex justify-end pt-6">
                        @if ($onboarding->completed)
                            Editing Locked!
                        @else
                            @if ($onboarding->owner_data)
                                <x-button-link href="{{ route('onboarding.owner.update', $onboarding->property) }}">
                                    {{ __('Edit') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @else
                                <x-button-link href="{{ route('onboarding.owner.create', $onboarding->property) }}">
                                    {{ __('Create') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Amenities --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold">Amenities</h3>
                        <p class="text-sm {{ $onboarding->amenities_data ? 'text-green-500' : 'text-orange-700' }}">
                            {{ $onboarding->amenities_data ? 'Completed' : 'Pending' }}</p>
                    </div>
                    <div class="flex justify-end pt-6">
                        @if ($onboarding->completed)
                            Editing Locked!
                        @else
                            @if ($onboarding->amenities_data)
                                <x-button-link href="{{ route('onboarding.amenities.update', $onboarding->property) }}">
                                    {{ __('Edit') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @else
                                <x-button-link href="{{ route('onboarding.amenities.update', $onboarding->property) }}">
                                    {{ __('Create') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Rooms --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold">Rooms</h3>
                        <p class="text-sm {{ $onboarding->rooms_data ? 'text-green-500' : 'text-orange-700' }}">
                            {{ $onboarding->rooms_data ? 'Completed' : 'Pending' }}</p>
                    </div>
                    <div class="flex justify-end pt-6">
                        @if ($onboarding->completed)
                            Editing Locked!
                        @else
                            @if ($onboarding->rooms_data)
                                <x-button-link href="{{ route('onboarding.rooms.update', $onboarding->property) }}">
                                    {{ __('Edit') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @else
                                <x-button-link href="{{ route('onboarding.rooms.update', $onboarding->property) }}">
                                    {{ __('Create') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Furnitures --}}
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold">Furnitures</h3>
                        <p class="text-sm {{ $onboarding->furnitures_data ? 'text-green-500' : 'text-orange-700' }}">
                            {{ $onboarding->furnitures_data ? 'Completed' : 'Pending' }}</p>
                    </div>
                    <div class="flex justify-end pt-6">
                        @if ($onboarding->completed)
                            Editing Locked!
                        @else
                            @if ($onboarding->furnitures_data)
                                <x-button-link href="{{ route('onboarding.furnitures.update', $onboarding->property) }}">
                                    {{ __('Edit') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @else
                                <x-button-link href="{{ route('onboarding.furnitures.update', $onboarding->property) }}">
                                    {{ __('Create') }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </x-button-link>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
