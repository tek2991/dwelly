<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Onboarding Property Amenities') }}
            </h2>
            <x-button-link href="{{ route('onboarding.show', $property->onboarding) }}">
                {{-- Back arrow svg --}}
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back</span>
            </x-button-link>
        </div>
    </x-slot>

    @livewire('onboarding.amenities-update' , ['property' => $property])
</x-app-layout>
