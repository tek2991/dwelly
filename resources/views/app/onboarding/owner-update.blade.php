<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Onboarding Owner Detail') }}
        </h2>
    </x-slot>

    @livewire('onboarding.owner-update' , ['property' => $property])
</x-app-layout>
