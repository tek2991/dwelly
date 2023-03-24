<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Onboarding Property Rooms') }}
        </h2>
    </x-slot>

    @livewire('onboarding.rooms-update' , ['property' => $property])
</x-app-layout>
