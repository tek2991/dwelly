<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Onboarding Owner Detail') }}
        </h2>
    </x-slot>

    @livewire('onboarding.owner-detail' , ['property_id' => $property->id])
</x-app-layout>
