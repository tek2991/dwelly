<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Onboarding Property') }}
        </h2>
    </x-slot>

    {{-- Create Property --}}
    @livewire('onboarding.property-update', ['property' => $property])
</x-app-layout>
